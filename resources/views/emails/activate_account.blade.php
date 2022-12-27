@extends('emails.layouts.app')

@section('title')
    {{ $data['title'] }}
@endsection

@section('content')
    <div class="u-row-container" style="padding: 0px;background-color: #a2c1d6">
        <div class="u-row" style="Margin: 0 auto;min-width: 320px;max-width: 600px;overflow-wrap: break-word;word-wrap: break-word;word-break: break-word;background-color: #ddf2fe;">
        <div style="border-collapse: collapse;display: table;width: 100%;height: 100%;background-color: transparent;">
            <!--[if (mso)|(IE)]><table width="100%" cellpadding="0" cellspacing="0" border="0"><tr><td style="padding: 0px;background-color: #a2c1d6;" align="center"><table cellpadding="0" cellspacing="0" border="0" style="width:600px;"><tr style="background-color: #ddf2fe;"><![endif]-->
            
            <!--[if (mso)|(IE)]><td align="center" width="600" style="width: 600px;padding: 0px;border-top: 0px solid transparent;border-left: 0px solid transparent;border-right: 0px solid transparent;border-bottom: 0px solid transparent;border-radius: 0px;-webkit-border-radius: 0px; -moz-border-radius: 0px;" valign="top"><![endif]-->
            <div class="u-col u-col-100" style="max-width: 320px;min-width: 600px;display: table-cell;vertical-align: top;">
            <div style="height: 100%;width: 100% !important;border-radius: 0px;-webkit-border-radius: 0px; -moz-border-radius: 0px;">
            <!--[if (!mso)&(!IE)]><!--><div style="height: 100%; padding: 0px;border-top: 0px solid transparent;border-left: 0px solid transparent;border-right: 0px solid transparent;border-bottom: 0px solid transparent;border-radius: 0px;-webkit-border-radius: 0px; -moz-border-radius: 0px;"><!--<![endif]-->
            
                <table id="u_content_text_1" style="font-family:arial,helvetica,sans-serif;" role="presentation" cellpadding="0" cellspacing="0" width="100%" border="0">
                <tbody>
                    <tr>
                        <td class="v-container-padding-padding" style="overflow-wrap:break-word;word-break:break-word;padding:44px 55px 70px;font-family:arial,helvetica,sans-serif;" align="left">
                            
                            <div class="v-text-align v-line-height" style="color: #536475; line-height: 180%; text-align: left; word-wrap: break-word;">
                                <p style="font-size: 14px; line-height: 180%;"><span style="font-size: 20px; line-height: 36px; font-family: 'trebuchet ms', geneva;">Hello {{ $data['name'] }},</span></p>
                                <p style="font-size: 14px; line-height: 180%;">
                                    <span style="font-size: 16px; line-height: 28.8px; font-family: 'trebuchet ms', geneva;">
                                        Your registration on Gemtrust was successful. You can always login to your Portal/Dashboard at <a href="{{ env('APP_URL') }}/portal">{{ env('APP_URL') }}/portal</a>
                                        <br />
                                        Please click on the link below to activate your account
                                    </span>
                                </p>
                                <p style="font-size: 14px; line-height: 180%;"><br /><span style="font-size: 16px; line-height: 28.8px; font-family: 'trebuchet ms', geneva;">
                                    <a href="{{ $data['link'] }}">
                                        <button style="border: 1 px solid #00FF00; border-radius: 10px; padding: 10px 15px; text-align: center; margin: 10px auto; background-color: #1010FF; color: #FFF;">Activate Account</button>
                                    </a>
                                </span></p>
                                <p style="font-size: 14px; line-height: 180%;"><br /><strong><span style="font-size: 16px; line-height: 28.8px; font-family: 'trebuchet ms', geneva;">Best regards,</span></strong><br /><span style="font-size: 16px; line-height: 28.8px; font-family: 'trebuchet ms', geneva;">Anderson Oyinpreye</span></p>
                            </div>
        
                        </td>
                    </tr>
                </tbody>
                </table>
    
            <!--[if (!mso)&(!IE)]><!--></div><!--<![endif]-->
            </div>
            </div>
            <!--[if (mso)|(IE)]></td><![endif]-->
            <!--[if (mso)|(IE)]></tr></table></td></tr></table><![endif]-->
        </div>
        </div>
    </div>
@endsection