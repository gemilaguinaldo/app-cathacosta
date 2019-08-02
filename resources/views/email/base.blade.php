<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
</head>
<body>
    <style>

         .header, .footer {
                padding: 1.5rem;
                background-color: #4267b2;
                border-bottom: 1px solid #29487d;
                color: #fff;
        }

        .header a {
                text-decoration: none;
                color: #006cff;
                font-size: 24px;
        }

        .body {
            min-height: 4rem;
        }
        
        @media only screen and (max-width: 600px) {
            .inner-body {
                width: 100% !important;
            }

            .footer {
                width: 100% !important;
            }
        }

        @media only screen and (max-width: 500px) {
            .button {
                width: 100% !important;
            }
        }
    </style>

    <table class="wrapper" width="100%" cellpadding="0" cellspacing="0">
        <tr>
            <td align="center">
                <table class="content" width="100%" cellpadding="0" cellspacing="0">
                    <tr>
					    <td class="header" class="content-cell" align="center">
					        <!-- <a href="{{ config('app.url') }}">
					            {{ config('app.name') }}
					        </a> -->
					    </td>
					</tr>

                    <!-- Email Body -->
                    <tr>
                        <td class="body" width="100%" cellpadding="0" cellspacing="0">
                            <table class="inner-body" align="center" width="570" cellpadding="0" cellspacing="0">
                                <!-- Body content -->
                                <tr>
                                    <td class="content-cell">
                                        @yield('content')
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>

                    
                    {{-- footer --}}
                    <tr>
                        <td>
                            <table class="footer" align="center" width="570" cellpadding="0" cellspacing="0">
                                <tr>
                                    <td class="content-cell" align="center">
                                        © {{ date('Y') }} {{ config('app.name') }} All rights reserved.
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                    {{-- footer --}}

                </table>
            </td>
        </tr>
    </table>
</body>
</html>
