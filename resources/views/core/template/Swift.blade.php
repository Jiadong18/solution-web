      <div class="row">
        <div class="col-xs-12">

<p>Please follow this step to set Swift Mail as your mail server</p>
<p>-&gt;&nbsp;<strong>Dashboard -&gt; Control Panel -&gt; Configuration -&gt; Login &amp; Security</strong></p>
<p>-&gt; Select Mail System ( SWIFT Mail )</p>
<p>-&gt;Open File .env and fill this following config matching your server info</p>
<ul>
<li>MAIL_DRIVER=smtp</li>
<li>MAIL_HOST=mail.managemybookings.net</li>
<li>MAIL_PORT=25</li>
<li>MAIL_USERNAME=demo@managemybookings.net</li>
<li>MAIL_PASSWORD=password</li>
<li>MAIL_ENCRYPTION=null</li>
</ul>
<p>Open File /config/mail.php and fill this following config</p>
<p>'host' =&gt; env('MAIL_HOST', 'your &nbsp;smtp host name'),</p>
<p>'port' =&gt; env('MAIL_PORT', 465),</p>
<p>'from' =&gt; ['address' =&gt; 'demo@managemybookings.net', 'name' =&gt; 'ManageMyBookings.net'], &nbsp;</p>
<p>thats it!!</p>
          </div>
</div>