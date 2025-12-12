<?php

namespace App\Http\Controllers;

use DB;
use Auth;
use File;
use Input;
use App\City;
use App\User;
use Redirect;
use App\Alert;
use App\State;
use App\Gender;
use Newsletter;
use App\Company;
use App\Country;
use App\Package;
use ImgUploader;
use App\Industry;
use App\JobApply;
use Carbon\Carbon;
use App\CareerLevel;
use App\Subscription;
use App\Http\Requests;
use App\JobExperience;
use App\MaritalStatus;
use App\Traits\Skills;
use App\FunctionalArea;
use App\ProfileSummary;
use App\ApplicantMessage;
use App\FavouriteCompany;
use Illuminate\Http\Request;
use App\Traits\ProfileCvsTrait;
use App\Helpers\DataArrayHelper;
use App\Traits\ProfileSkillTrait;
use Illuminate\Http\UploadedFile;
use App\Traits\CommonUserFunctions;
use App\Traits\ProfileSummaryTrait;
use App\Http\Controllers\Controller;
use App\Traits\ProfileLanguageTrait;
use App\Traits\ProfileProjectsTrait;
use Illuminate\Support\Facades\Hash;
use App\Traits\ProfileEducationTrait;
use App\Traits\ProfileExperienceTrait;
use App\Http\Requests\Front\UserFrontFormRequest;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class UserController extends Controller
{

    use CommonUserFunctions;
    use ProfileSummaryTrait;
    use ProfileCvsTrait;
    use ProfileProjectsTrait;
    use ProfileExperienceTrait;
    use ProfileEducationTrait;
    use ProfileSkillTrait;
    use ProfileLanguageTrait;
    use Skills;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //$this->middleware('auth', ['only' => ['myProfile', 'updateMyProfile', 'viewPublicProfile']]);
        $this->middleware('auth', ['except' => ['showApplicantProfileEducation', 'showApplicantProfileProjects', 'showApplicantProfileExperience', 'showApplicantProfileSkills', 'showApplicantProfileLanguages']]);
    }

    public function viewPublicProfile($id)
    {

        $user = User::findOrFail($id);
        $profileCv = $user->getDefaultCv();

        return view('user.applicant_profile')
            ->with('user', $user)
            ->with('profileCv', $profileCv)
            ->with('page_title', $user->getName())
            ->with('form_title', 'Contact ' . $user->getName());
    }

    public function myProfile()
    {
        $genders = DataArrayHelper::langGendersArray();
        $maritalStatuses = DataArrayHelper::langMaritalStatusesArray();
        $nationalities = DataArrayHelper::langNationalitiesArray();
        $countries = DataArrayHelper::langCountriesArray();
        $jobExperiences = DataArrayHelper::langJobExperiencesArray();
        $careerLevels = DataArrayHelper::langCareerLevelsArray();
        $industries = DataArrayHelper::langIndustriesArray();
        $functionalAreas = DataArrayHelper::langFunctionalAreasArray();
        $jobTitles = DataArrayHelper::langJobTitlesArray();

        $upload_max_filesize = UploadedFile::getMaxFilesize() / (1048576);
        $user = User::findOrFail(Auth::user()->id);
        return view('user.edit_profile')
            ->with('genders', $genders)
            ->with('maritalStatuses', $maritalStatuses)
            ->with('nationalities', $nationalities)
            ->with('countries', $countries)
            ->with('jobExperiences', $jobExperiences)
            ->with('careerLevels', $careerLevels)
            ->with('industries', $industries)
            ->with('functionalAreas', $functionalAreas)
            ->with('user', $user)
            ->with('jobTitles', $jobTitles)
            ->with('upload_max_filesize', $upload_max_filesize);
    }

    public function updateMyProfile(UserFrontFormRequest $request)
{
    $user = User::findOrFail(Auth::user()->id);

    /* ------------------------------------ */
    /* تحديث صورة البروفايل */
    if ($request->hasFile('image')) {
        $this->deleteUserImage($user->id);
        $image = $request->file('image');
        $fileName = ImgUploader::UploadImage('user_images', $image, $request->input('name'), 300, 300, false);
        $user->image = $fileName;
    }

    /* تحديث صورة الغلاف */
    if ($request->hasFile('cover_image')) {
        $this->deleteUserCoverImage($user->id);
        $cover_image = $request->file('cover_image');
        $fileName_cover_image = ImgUploader::UploadImage('user_images', $cover_image, $request->input('name'), 1140, 250, false);
        $user->cover_image = $fileName_cover_image;
    }

    /* تحديث ملف السيرة الذاتية */
    if ($request->hasFile('cv_document')) {

        // delete old CV document
        $this->deleteUserDocument($user->id);

        // uploaded file
        $cv_document = $request->file('cv_document');

        // upload CV file
        $fileName_cv_document = ImgUploader::UploadDoc('user_documents', $cv_document, $request->input('name'));

        // save to user record
        $user->cv_document = $fileName_cv_document;
    }

    /* ------------------------------------ */
    /* تحديث بيانات المستخدم */
    $user->first_name = $request->input('first_name');
    $user->last_name = $request->input('last_name');
    $user->name = $user->getName();
    $user->email = $request->input('email');

    if (!empty($request->input('password'))) {
        $user->password = Hash::make($request->input('password'));
    }

    $user->date_of_birth = $request->input('date_of_birth');
    $user->job_title_id = $request->input('job_title_id');
    $user->mobile_num = $request->input('mobile_num');
    $user->video_link = $request->video_link;
    $user->street_address = $request->input('street_address');
    $user->is_subscribed = $request->input('is_subscribed', 0);

    /* ------------------------------------ */
    /* تحديث الـ Summary */
    if ($request->filled('summary')) {

        // حذف الملخص السابق
        ProfileSummary::where('user_id', $user->id)->delete();

        // إضافة الملخص الجديد
        $profileSummary = new ProfileSummary();
        $profileSummary->user_id = $user->id;
        $profileSummary->summary = $request->input('summary');
        $profileSummary->save();
    }

    /* حفظ بيانات المستخدم */
    $user->update();

    /* تحديث الفول تكست سيرش */
    $this->updateUserFullTextSearch($user);

    /* ------------------------------------ */
    /* الاشتراك في القائمة البريدية */
    Subscription::where('email', 'like', $user->email)->delete();

    if ((bool)$user->is_subscribed) {
        $subscription = new Subscription();
        $subscription->email = $user->email;
        $subscription->name = $user->name;
        $subscription->save();
    }

    flash(__('You have updated your profile successfully'))->success();
    return \Redirect::route('my.profile');
}

    public function addToFavouriteCompany(Request $request, $company_slug)
    {
        $data['company_slug'] = $company_slug;
        $data['user_id'] = Auth::user()->id;
        $data_save = FavouriteCompany::create($data);
        flash(__('Company has been added in favorites list'))->success();
        return \Redirect::route('company.detail', $company_slug);
    }

    public function removeFromFavouriteCompany(Request $request, $company_slug)
    {
        $user_id = Auth::user()->id;
        FavouriteCompany::where('company_slug', 'like', $company_slug)->where('user_id', $user_id)->delete();

        flash(__('Company has been removed from favorites list'))->success();
        return \Redirect::route('company.detail', $company_slug);
    }

    public function myFollowings()
    {
        $user = User::findOrFail(Auth::user()->id);
        $companiesSlugArray = $user->getFollowingCompaniesSlugArray();
        $companies = Company::whereIn('slug', $companiesSlugArray)->get();

        return view('user.following_companies')
            ->with('user', $user)
            ->with('companies', $companies);
    }

    public function myMessages()
    {
        $user = User::findOrFail(Auth::user()->id);
        $messages = ApplicantMessage::where('user_id', '=', $user->id)
            ->orderBy('is_read', 'asc')
            ->orderBy('created_at', 'desc')
            ->get();

        return view('user.applicant_messages')
            ->with('user', $user)
            ->with('messages', $messages);
    }

    public function applicantMessageDetail($message_id)
    {
        $user = User::findOrFail(Auth::user()->id);
        $message = ApplicantMessage::findOrFail($message_id);
        $message->update(['is_read' => 1]);

        return view('user.applicant_message_detail')
            ->with('user', $user)
            ->with('message', $message);
    }

    public function myAlerts()
    {
        $alerts = Alert::where('email', Auth::user()->email)
            ->orderBy('created_at', 'desc')
            ->get();
        //dd($alerts);
        return view('user.applicant_alerts')
            ->with('alerts', $alerts);
    }
    public function delete_alert($id)
    {
        $alert = Alert::findOrFail($id);
        $alert->delete();
        $arr = array('msg' => 'A Alert has been successfully deleted. ', 'status' => true);
        return Response()->json($arr);
    }
    public function ResumeFetch($id)
    {
        $user = User::findOrFail($id);
        $profileCv = $user->getDefaultCv();
        return view('user.resume')
            ->with('user', $user)
            ->with('profileCv', $profileCv)
            ->with('page_title', $user->getName())
            ->with('form_title', 'Contact ' . $user->getName());
    }


    public function buildResume()
    {
        $upload_max_filesize = UploadedFile::getMaxFilesize() / (1048576);
        $user = User::findOrFail(Auth::user()->id);

        return view('user.build_resume')
            ->with('user', $user)
            ->with('upload_max_filesize', $upload_max_filesize);
    }


    public function indexCandidateHistory()
    {
        $user = auth()->user();

        // Try to get payment history from payment_history table first
        $candidatePayments = \App\PaymentHistory::where('user_id', $user->id)
            ->with('package')
            ->orderBy('created_at', 'DESC')
            ->get();

        // If no records in payment_history, show current package as fallback
        if ($candidatePayments->isEmpty() && $user->package_id) {
            // Create a temporary collection with current package data
            $currentPackage = new \stdClass();
            $currentPackage->package = $user->getPackage();
            $currentPackage->payment_method = $user->payment_method ?? 'Admin Assign';
            $currentPackage->package_start_date = $user->package_id == 9
                ? $user->featured_package_start_at
                : $user->package_start_date;
            $currentPackage->package_end_date = $user->package_id == 9
                ? $user->featured_package_end_at
                : $user->package_end_date;
            $currentPackage->jobs_quota = $user->jobs_quota ?? 0;
            $currentPackage->package_type = $user->package_id == 9 ? 'featured_profile' : 'job_seeker';

            $candidatePayments = collect([$currentPackage]);
        }

        $siteSetting = \App\SiteSetting::first();

        return view('user.payment_history', compact('candidatePayments', 'siteSetting'));
    }





    public function fetchCandidatesHistory(Request $request)
    {


        $candidates = User::select('*')->whereNotNull('featured_package_start_at');

        return Datatables::of($candidates)
            ->filter(function ($query) use ($request) {
                if ($request->has('name') && !empty($request->name)) {
                    $query->where('users.name', 'like', "%{$request->get('name')}%");
                }
                if ($request->has('payment_method') && !empty($request->payment_method)) {
                    $query->where('users.payment_method', 'like', "%{$request->get('payment_method')}%");
                }
                if ($request->has('package') && !empty($request->package)) {
                    $query->where('users.package_id', $request->get('package'));
                }
                $query->orderBy('featured_package_start_at', 'DESC');
            })
            ->addColumn('payment_method', function ($candidates) {
                return !empty($candidates->payment_method) && $candidates->payment_method !== 'offline'
                    ? $candidates->payment_method
                    : 'Offline (Added by Admin)';
            })
            ->addColumn('package', function ($candidates) {
                $package = Package::find($candidates->package_id);
                return $package ? $package->package_title : 'N/A';
            })
            ->addColumn('package_num_days', function ($candidates) {
                return $candidates->package_num_days ?? 'N/A';
            })
            ->addColumn('featured_package_start_at', function ($candidates) {
                return $candidates->featured_package_start_at
                    ? date('d-m-Y', strtotime($candidates->featured_package_start_at))
                    : 'N/A';
            })
            ->addColumn('featured_package_end_at', function ($candidates) {
                return $candidates->featured_package_end_at
                    ? date('d-m-Y', strtotime($candidates->featured_package_end_at))
                    : 'N/A';
            })
            ->rawColumns(['featured_package_start_at', 'featured_package_end_at'])
            ->setRowId(function ($candidates) {
                return 'candidateDtRow' . $candidates->id;
            })
            ->make(true);
    }

    public function package()
    {
        $user = Auth::user();
        $package = $user->getPackage();

        // Only fetch packages for purchase/upgrade if the feature is enabled
        // But ALWAYS allow users to see their existing package
        if ((bool)config('jobseeker.is_jobseeker_package_active')) {
            if (null !== $package) {
                // User has package - show upgrade options
                $packages = Package::where('package_for', 'like', 'job_seeker')
                    ->where('id', '<>', $package->id)
                    ->where('package_price', '>=', $package->package_price)
                    ->get();
            } else {
                // User has no package - show all available packages
                $packages = Package::where('package_for', 'like', 'job_seeker')->get();
            }
        } else {
            // Package system is disabled - don't show any packages for purchase
            // But user can still see their existing package in the view
            $packages = collect();
        }

        return view('user.package')
            ->with('user', $user)
            ->with('package', $package)
            ->with('packages', $packages);
    }
}
