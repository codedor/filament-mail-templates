<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
        <meta name="color-scheme" content="light">
        <meta name="supported-color-schemes" content="light">

        <style>
            @media only screen and (max-width: 600px) {
                .inner-body {
                    width: 100% !important;
                }

                .footer {
                    width: 100% !important;
                }
            }

            /* Base */
            body {
                margin: 0;
                width: 100%;
                height: 100%;

                hyphens: auto;
                -moz-hyphens: auto;
                -ms-word-break: break-all;
                -webkit-hyphens: auto;
                -webkit-text-size-adjust: none;
                word-break: break-all;
                word-break: break-word;
            }

            .wrapper,
            .content {
                margin: 0;
                padding: 0;
                width: 100%;

                -premailer-cellpadding: 0;
                -premailer-cellspacing: 0;
                -premailer-width: 100%;
            }

            /* Body */
            .inner-body {
                margin: 0 auto;
                padding: 0;
                width: 570px;

                -premailer-cellpadding: 0;
                -premailer-cellspacing: 0;
                -premailer-width: 570px;
            }
        </style>
    </head>

    <body>
        <table
            class="wrapper"
            width="100%"
            cellpadding="0"
            cellspacing="0"
            role="presentation"
        >
            <tr>
                <td align="center">
                    <table
                        class="content"
                        width="100%"
                        cellpadding="0"
                        cellspacing="0"
                        role="presentation"
                    >
                        <tr>
                            <td>
                                <div class="inner-body">
                                    <!-- Header -->
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td
                                class="content"
                                width="100%"
                                cellpadding="0"
                                cellspacing="0"
                            >
                                <table
                                    class="inner-body"
                                    align="center"
                                    width="640"
                                    cellpadding="0"
                                    cellspacing="0"
                                    role="presentation"
                                >
                                    <!-- Body content -->
                                    <tr>
                                        <td class="content-cell">
                                            {{ $body }}
                                        </td>
                                    </tr>
                                </table>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <table
                                    class="footer"
                                    align="center"
                                    width="570"
                                    cellpadding="0"
                                    cellspacing="0"
                                    role="presentation"
                                >
                                    <tr>
                                        <td align="center">
                                            <div class="inner-body">
                                                <!-- Footer -->
                                            </div>
                                        </td>
                                    </tr>
                                </table>
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
        </table>
    </body>
</html>
