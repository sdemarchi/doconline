<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
        <title>Doc Online</title>
        <meta name="viewport" content="width=device-width" />
       <style type="text/css">
            @media only screen and (max-width: 550px), screen and (max-device-width: 550px) {
                body[yahoo] .buttonwrapper { background-color: transparent !important; }
                body[yahoo] .button { padding: 0 !important; }
                body[yahoo] .button a { background-color: #46b7bf; padding: 15px 25px !important; }
            }

            @media only screen and (min-device-width: 601px) {
                .content { width: 600px !important; }
                .col387 { width: 387px !important; }
            }
        </style>
    </head>
    <body bgcolor="#13A8C6" style="margin: 0; padding: 0;" yahoo="fix">
        <table align="center" border="0" cellpadding="0" cellspacing="0" style="border-collapse: collapse; width: 100%; max-width: 600px;" class="content">
            <tr>
                <td align="left" bgcolor="#ffffff" style="padding: 40px 20px 20px 20px; color: #3c3c3c; font-family: Arial, sans-serif; font-size: 16px; border-bottom: 0px;">
                        {!! nl2br(strip_tags($mensaje, '<b><strong><i><u><br><mark><h1><h2><h3><h4><h5><h6><div>')) !!}
                    <br/><br/>
                </td>
            </tr>
        </table>

    </body>
</html>
