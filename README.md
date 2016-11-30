# Kindlegen-web
A very simple webpage, to which you can upload ePub files and several other formats not supported by Kindle, and convert them to mobi, after which the file is sent them your Kindle. It is effectively a html/php wrapper for Amazon's own Kindlegen application.

You need to approve a@b.com (or whatever email address you choose in the upload.php file) to send ebooks to your Kindle. To do this, go to your Kindle settings (https://www.amazon.com/mn/dcw/myx.html/ref=kinw_myk_redirect#/home/settings/payment), and then down to the "Approved Personal Document E-mail List" section.
This code assumes you're running a web server on Linux. I didn't bother making a Windows version, since if you have a web server it's probably running Linux anyway. But it shouldn't be too hard to make it Windows or OSX compatible, just use the correct version of Kindlegen for your OS and adapt the commands used in upload.php for your OS. There's a couple of shell_exec()s.

The included Kindlegen application is property of Amazon.com, and they hold all rights to this app (https://www.amazon.com/gp/feature.html?docId=1000234621). The included version is Amazon kindlegen(Linux) V2.9 build 1028-0897292. I will not be updating this, so I recommend using the binary from Amazon.
For the mailing service, the PHPMailer library was used (https://github.com/PHPMailer/PHPMailer). 
