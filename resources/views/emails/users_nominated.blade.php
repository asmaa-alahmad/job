@extends('admin.layouts.email_template')

@section('content')
<table border="0" cellpadding="0" cellspacing="0" class="force-row" style="width: 100%; border-bottom: solid 1px #ccc;">
    <tr>
        <td class="content-wrapper" style="padding-left:24px;padding-right:24px"><br>
            <div class="title" style="font-family: Helvetica, Arial, sans-serif; font-size: 18px;font-weight:400;color: #000;text-align: left;
                 padding-top: 20px;">
                 {{ __('Dear') }} {{ $company->name }},
            </div>
        </td>
    </tr>
    <tr>
        <td class="cols-wrapper" style="padding-left:12px;padding-right:12px">
            <table border="0" cellpadding="0" cellspacing="0" align="left" class="force-row" style="width: 100%;">
                <tr>
                    <td class="row" valign="top" style="padding-left:12px;padding-right:12px;padding-top:18px;padding-bottom:12px">
                        <table border="0" cellpadding="0" cellspacing="0" style="width:100%;">
                            <tr>
                                <td class="subtitle" style="font-family:Helvetica, Arial, sans-serif;font-size:14px;line-height:22px;font-weight:400;color:#333;padding-bottom:30px; text-align: left;">
                                    {{ __('We have nominated the following users for your company') }}:
                                    <br><br>

                                    <table border="1" cellpadding="5" cellspacing="0" style="width:100%; border-collapse: collapse;">
                                        <thead>
                                            <tr style="background-color:#f5f5f5;">
                                                <th style="text-align:left;">{{ __('Name') }}</th>
                                                <th style="text-align:left;">{{ __('Email') }}</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($users as $user)
                                            <tr>
                                                <td>{{ $user->name }}</td>
                                                <td>{{ $user->email }}</td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>

                                    <br>
                                    <span style="color: #fff;text-decoration: none;background: #f25a55; padding: 7px 10px;text-align: center;display: inline-block;margin-top: 20px;">
                                        {{ __('You can respond to this email by replying to this email') }}.
                                    </span>
                                    <br><br>
                                </td>
                            </tr>
                            <tr>
                                <td style="font-family: Helvetica, Arial, sans-serif;font-size: 14px;line-height: 22px;font-weight: 400;color: #333; padding-bottom: 30px;text-align: left;">
                                    <p style="margin-top:10px;">
                                        {{ __('Warm regards') }}, <br>
                                        {{ $siteSetting->site_name }} Team
                                    </p>
                                </td>
                            </tr>
                        </table>
                        <br>
                    </td>
                </tr>
            </table>
        </td>
    </tr>
</table>
@endsection