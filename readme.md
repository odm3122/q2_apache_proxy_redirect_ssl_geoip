<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>

<head>
<meta http-equiv=Content-Type content="text/html; charset=utf-8">
<meta name=Generator content="Microsoft Word 10 (filtered)">
<title>readme.md</title>
</head>

<body lang=DE-CH link=blue vlink=purple>

<div class=Section1>

Q2 - Setup a web server. It can response on http on port 80 and will forward all http request
to https (port 443). For example: GET http://server.fqdn/site/ will redirect to
https://server.fqdn/site/
On this web server, it should response according to user’s GEOIP location. For example from
Switzerland, it should response ”Welcome, user from Switzerland, your IP is X.Y.Z.0”
Please provide simple installation guide, configuration and source code to the site.

<p><br>
Answer:</p>

<h1><a name="_Toc451941904"><span lang=EN-GB style='font-family:Arial'><u1:p></u1:p></u1:smarttagtype><u1:smarttagtype namespaceuri="urn:schemas-microsoft-com:office:smarttags" name="place"></u1:smarttagtype><u1:smarttagtype namespaceuri="urn:schemas-microsoft-com:office:smarttags" name="place">Q2
Apache HTTP Server Proxy redirect http to https and redirect based on geoip</span></a><span
lang=EN-GB style='font-family:Arial'> - Prototype<u1:p></u1:p></span></h1>

<p class=MsoToc1><span
class=MsoHyperlink><a href="#_Toc451941904"><span lang=EN-GB style='font-family:
Arial'>Q2 Apache HTTP Server Proxy redirect http to https and redirect based on
geoip</span><span style='color:windowtext;display:none;text-decoration:none'>. 1</span></a></span></p>

<u1:p></u1:p>

<p class=MsoToc1><span class=MsoHyperlink><a href="#_Toc451941905"><span
style='font-family:Arial'>Introduction</span><span style='color:windowtext;
display:none;text-decoration:none'>. 1</span></a></span></p>

<u1:p></u1:p>

<p class=MsoToc1><span class=MsoHyperlink><a href="#_Toc451941906"><span
lang=EN-GB style='font-family:Arial'>Step 1: Install Apache2 and Disable any
existing site</span><span style='color:windowtext;display:none;text-decoration:
none'>. 1</span></a></span></p>

<u1:p></u1:p>

<p class=MsoToc1><span class=MsoHyperlink><a href="#_Toc451941907"><span
lang=EN-GB style='font-family:Arial'>Step 2: Configure&nbsp;http://odm3122.selfhost.de:80/</span><span
style='color:windowtext;display:none;text-decoration:none'> 2</span></a></span></p>

<u1:p></u1:p>

<p class=MsoToc1><span class=MsoHyperlink><a href="#_Toc451941908"><span
style='font-family:Arial'>Step 3: Enable SSL</span><span style='color:windowtext;
display:none;text-decoration:none'>. 2</span></a></span></p>

<u1:p></u1:p>

<p class=MsoToc1><span class=MsoHyperlink><a href="#_Toc451941909"><span
lang=EN-GB style='font-family:Arial'>Step 4:
Configure&nbsp;https://odm3122.selfhost.de:443/</span><span style='color:windowtext;
display:none;text-decoration:none'> 5</span></a></span></p>

<u1:p></u1:p>

<p class=MsoToc1><span class=MsoHyperlink><a href="#_Toc451941910"><span
lang=EN-GB style='font-family:Arial'>Step 4: Enable Virtual Hosts</span><span
style='color:windowtext;display:none;text-decoration:none'>. 7</span></a></span></p>

<u1:p></u1:p>

<p class=MsoToc1><span class=MsoHyperlink><a href="#_Toc451941911"><span
lang=EN-GB style='font-family:Arial'>Step 5: Activate new Configuration</span><span
style='color:windowtext;display:none;text-decoration:none'>. 8</span></a></span></p>

<u1:p></u1:p>

<h1><span lang=EN-GB style='font-family:Arial'><u1:p>&nbsp;</u1:p></span></h1>

<h1><a name="_Toc451941905"><span style='font-family:Arial'>Introduction</span></a></h1>

<u1:p></u1:p>

<p><span lang=EN-GB>The HTTP Server on the Management Server has the following
responsibilities<u1:p></u1:p></span></p>

<ul type=disc>
 <li class=MsoNormal><span lang=EN-GB style='font-size:10.0pt;font-family:Arial'>Entry
     point to the odm3122.selfhost.de/site/ </span></li>
 <u1:p></u1:p>
 <li class=MsoNormal><span lang=EN-GB>Any Request that does not belong to </span><span
     lang=EN-GB style='font-size:10.0pt;font-family:Arial'>duuig.local/site/ </span><span
     lang=EN-GB>must be forwarded to the secure ssl connection<u1:p></u1:p></span></li>
</ul>

<p class=MsoNormal><span lang=EN-GB><u1:p>&nbsp;</u1:p></span></p>

<h4><span lang=EN-GB style='font-family:Arial'>Virtual Hosts<u1:p></u1:p></span></h4>

<p><span lang=EN-GB>The term Virtual Host refers to the practice of running
more than one web site on a single machine. </span>We use the Virtual Hosts to
serve multiple ports:</p>

<ul type=disc>
 <li class=MsoNormal><span lang=EN-GB style='font-size:10.0pt;font-family:Arial'>http://puppetagent1.duuig.local:80/<u1:p></u1:p></span></li>
 <li class=MsoNormal><span lang=EN-GB>https://puppetagent1.duuig.local:443&nbsp;</span></li>
</ul>

<u1:p></u1:p>

<h4><span lang=EN-GB style='font-family:Arial'>Base Image<u1:p></u1:p></span></h4>

<p class=MsoNormal><span lang=EN-GB>Ubuntu Server 16.4 with Malignance Tools Software
Package<u1:p></u1:p></span></p>

<h1><a name="_Toc451941906"><span lang=EN-GB style='font-family:Arial'>Step 1:
Install Apache2 and Disable any existing site</span></a></h1>

<u1:p></u1:p>

<h4><span lang=EN-GB style='font-family:Arial'>Install Apache<u1:p></u1:p></span></h4>

<pre><span lang=EN-GB>sudo apt-get install apache2<u1:p></u1:p></span></pre><pre><span
lang=EN-GB><u1:p>&nbsp;</u1:p></span></pre><pre><span lang=EN-GB>Activate the Modules:<u1:p></u1:p></span></pre><pre><span
lang=EN-GB><u1:p>&nbsp;</u1:p></span></pre><pre><code><span lang=EN-GB>sudo a2enmod proxy_http<u1:p></u1:p></span></code></pre><pre><code><span
lang=EN-GB>sudo a2enmod rewrite</span></code></pre><u1:p></u1:p>

<h4><span lang=EN-GB>Disable all apache sites<u1:p></u1:p></span></h4>

<pre><span lang=EN-GB># sudo a2dissite *&nbsp;<u1:p></u1:p></span></pre>

<p><span lang=EN-GB>Do not activate the new configuration yet.<u1:p></u1:p></span></p>

<h1><a name="_Toc451941907"><span lang=EN-GB style='font-family:Arial'>Step 2:
Configure&nbsp;http://odm3122.selfhost.de:80/</span></a></h1>

<u1:p></u1:p>

<p><span lang=EN-GB style='font-size:10.0pt'>This Virtual Host redirects every
request to the Odm3122.selfhost.de Website
at&nbsp;http://www.odm3122.selfhost.de/.</span></p>

<u1:p></u1:p>

<p class=MsoNormal><b><span lang=FR style='font-family:Arial'>/etc/apache2/sites-available/odm3122.conf</span></b></p>

<p class=MsoNormal><br>
<br>
</p>

<u1:p></u1:p><pre><span lang=EN-GB>https://github.com/odm3122/q2_apache_proxy_redirect_ssl_geoip/blob/master/odm3122.conf<br>
<br>
<br>
<br>
</span></pre><u1:p></u1:p><pre><span lang=EN-GB>  </span>      ProxyRequests Off<span
lang=EN-GB> -&gt;  disables forward proxy requests.<br>
<br>
<br>
</span></pre><u1:p></u1:p><pre><span lang=EN-GB>        R=301  does a permanent (</span><a
href="http://en.wikipedia.org/wiki/HTTP_301"><span lang=EN-GB>HTTP 301</span></a><span
lang=EN-GB>) redirect of any request to&nbsp;http://www.odm3122.selfhost.de./&nbsp;preserving the uri.<u1:p></u1:p></span></pre>

<h1><a name="_Toc451941908"><span style='font-family:Arial'>Step 3: Enable SSL</span></a><span
style='font-family:Arial'> </span></h1>

<u1:p></u1:p>

<h4><span style='font-family:Arial'>Enable ssl mod<u1:p></u1:p></span></h4>

<pre><code>sudo a2enmod ssl<u1:p></u1:p></code></pre><pre><code><u1:p>&nbsp;</u1:p></code></pre><pre><code><span
lang=EN-GB>sudo service apache2 restart<u1:p></u1:p></span></code></pre><pre><span
lang=EN-GB><u1:p>&nbsp;</u1:p></span></pre>

<h4><span lang=EN-GB style='font-family:Arial'>Enable port 443<u1:p></u1:p></span></h4>

<p><span lang=EN-GB>Just add or check one single line (line 16) to&nbsp;</span><code><span
lang=EN-GB style='font-size:10.0pt'>ports.conf</span></code><span lang=EN-GB>.<u1:p></u1:p></span></p>

<p class=MsoNormal><b><span lang=FR style='font-family:Arial'>/etc/apache2/ports.conf</span></b></p>

<u1:p></u1:p><pre><span lang=FR>Listen 443<u1:p></u1:p></span></pre>

<p><span lang=EN-GB>The full file should look as follows<u1:p></u1:p></span></p>

<p class=MsoNormal><b><span lang=EN-GB style='font-family:Arial'>/etc/apache2/ports.conf</span></b></p>

<u1:p></u1:p><pre><span lang=EN-GB># If you just change the port or add more ports here, you will likely also<u1:p></u1:p></span></pre><pre><span
lang=EN-GB># have to change the VirtualHost statement in<u1:p></u1:p></span></pre><pre><span
lang=EN-GB># /etc/apache2/sites-enabled/000-default<u1:p></u1:p></span></pre><pre><span
lang=EN-GB># This is also true if you have upgraded from before 2.2.9-3 (i.e. from<u1:p></u1:p></span></pre><pre><span
lang=EN-GB># Debian etch). See /usr/share/doc/apache2.2-common/NEWS.Debian.gz and<u1:p></u1:p></span></pre><pre><span
lang=EN-GB># README.Debian.gz<u1:p></u1:p></span></pre><pre><span lang=EN-GB>NameVirtualHost *:80<u1:p></u1:p></span></pre><pre><span
lang=EN-GB>Listen 80<u1:p></u1:p></span></pre><pre><span lang=EN-GB>&lt;IfModule mod_ssl.c&gt;<u1:p></u1:p></span></pre><pre><span
lang=EN-GB>    # If you add NameVirtualHost *:443 here, you will also have to change<u1:p></u1:p></span></pre><pre><span
lang=EN-GB>    </span># the VirtualHost statement in /etc/apache2/sites-available/default-ssl</pre><pre><span
lang=EN-GB>    # to &lt;VirtualHost *:443&gt;<u1:p></u1:p></span></pre><pre><span
lang=EN-GB>    # Server Name Indication for SSL named virtual hosts is currently not<u1:p></u1:p></span></pre><pre><span
lang=EN-GB>    # supported by MSIE on Windows XP.<u1:p></u1:p></span></pre><pre><span
lang=EN-GB>    NameVirtualHost *:443<u1:p></u1:p></span></pre><pre><span
lang=EN-GB>    Listen 443<u1:p></u1:p></span></pre><pre><span lang=EN-GB>&lt;/IfModule&gt;<u1:p></u1:p></span></pre><pre><span
lang=EN-GB>&lt;IfModule mod_gnutls.c&gt;<u1:p></u1:p></span></pre><pre><span
lang=EN-GB>    Listen 443<u1:p></u1:p></span></pre><pre><span lang=EN-GB>&lt;/IfModule&gt;<u1:p></u1:p></span></pre><pre><span
lang=EN-GB><u1:p>&nbsp;</u1:p></span></pre>

<h4><span lang=EN-GB style='font-family:Arial'>Generate Self signet Certs (Only
Test Env)<u1:p></u1:p></span></h4>

<pre><code><span lang=FR>sudo mkdir /etc/apache2/ssl.cert<u1:p></u1:p></span></code></pre><pre><code><span
lang=FR><u1:p>&nbsp;</u1:p></span></code></pre><pre><code><span lang=FR>sudo openssl req -x509 -nodes -days 365 -newkey rsa:2048 -keyout /etc/apache2/ssl.cert/</span></code><span
lang=FR>odm3122selfhost<code>.key -out /etc/apache2/ssl.cert/</code>odm3122selfhost<code>.crt</code><u1:p></u1:p></span></pre><pre><span
lang=FR><u1:p>&nbsp;</u1:p></span></pre>

<p class=MsoNormal><span lang=EN-GB>When you hit &quot;ENTER&quot;, you will be
asked a number of questions.<u1:p></u1:p></span></p>

<p class=MsoNormal><span lang=EN-GB>The most important item that is requested
is the line that reads &quot;Common Name (e.g. server FQDN or YOUR name)&quot;.
You should enter the domain name you want to associate with the certificate, or
the server's public IP address if you do not have a domain name.<u1:p></u1:p></span></p>

<p class=MsoNormal><b><span lang=EN-GB>In our case the Common Name is: </span></b><b><span
lang=EN-GB style='font-family:Arial'>odm3122.selfhost.de</span></b></p>

<u1:p></u1:p>

<h4><span lang=EN-GB style='font-family:Arial'>Install Mod geoip<u1:p></u1:p></span></h4>

<pre><span lang=EN-GB>sudo apt-get install libapache2-mod-geoip <u1:p></u1:p></span></pre>

<p class=MsoNormal><span lang=EN-GB><u1:p>&nbsp;</u1:p></span></p>

<p class=MsoNormal><b><span lang=EN-GB>Load Database<u1:p></u1:p></span></b></p>

<pre><span lang=EN-GB>cd /usr/share/GeoIP<u1:p></u1:p></span></pre><pre><span
lang=EN-GB>sudo wget geolite.maxmind.com/download/geoip/database/GeoLiteCity.dat.gz<u1:p></u1:p></span></pre><pre>sudo gunzip GeoLiteCity.dat.gz</pre><pre><u1:p>&nbsp;</u1:p></pre>

<p class=MsoNormal><span lang=EN-GB>Enable module geoip:<u1:p></u1:p></span></p>

<pre><code><span lang=EN-GB>sudo a2enmod </span>geoip</code><u1:p></u1:p></pre>

<h4><span lang=EN-GB style='font-family:Arial'><u1:p>&nbsp;</u1:p></span></h4>

<p><b><span lang=EN-GB>geoip Testscript:<u1:p></u1:p></span></b></p>

<p><b><span lang=EN-GB>to test with the php site you need php<u1:p></u1:p></span></b></p>

<pre><span lang=EN-GB>sudo apt-get update <u1:p></u1:p></span></pre><pre><span
lang=EN-GB>sudo apt-get install <code>php7.0<u1:p></u1:p></code></span></pre><pre><code><span
lang=EN-GB>sudo apt-get install libapache2-mod-php7.0</span></code></pre><u1:p></u1:p><pre><code>sudo a2enmod php7.0<u1:p></u1:p></code></pre><pre><code><u1:p>&nbsp;</u1:p></code></pre><pre><span
lang=EN-GB>sudo service apache2 restart<u1:p></u1:p></span></pre><pre><span
lang=EN-GB><u1:p>&nbsp;</u1:p></span></pre>

<h4><span lang=EN-GB style='font-family:Arial'>/var/www/html/phptest.php<u1:p></u1:p></span></h4>

<h4><i><span lang=EN-GB style='font-size:9.0pt;font-family:Arial;font-weight:
normal'>&lt;?php phpinfo(); ?&gt;<u1:p></u1:p></span></i></h4>

<pre><code>now you should see the php info page<u1:p></u1:p></code></pre>

<h4><span lang=EN-GB style='font-family:Arial'>/var/www/html/geoip.php<u1:p></u1:p></span></h4>

<p><b><span lang=EN-GB>Hint: You need a Free Proxy in <st1:country-region><st1:place>France</st1:place></st1:country-region>
and another Country  to test  it<u1:p></u1:p></span></b></p>

<p><span lang=EN-GB>Check a Proxylist for the IP and Port of a open proxy:
http://gatherproxy.com/proxylist/country/?c=France<u1:p></u1:p></span></p>

<p><b><span lang=EN-GB><u1:p>&nbsp;</u1:p></span></b></p>

<h1><a name="_Toc451941909"><span lang=EN-GB style='font-family:Arial'>Step 4:
Configure&nbsp;https://odm3122.selfhost.de:443/</span></a></h1>

<u1:p></u1:p>

<p><span lang=EN-GB>This Virtual Host is responsible to proxy valid requests
either to a Odm3122.selfhost.de Instance or to OMD. Everything else is
redirected to the Odm3122.selfhost.de Website
at&nbsp;http://www.odm3122.selfhost.de/.<u1:p></u1:p></span></p>

<table class=MsoNormalTable border=1 cellpadding=0 style='background:#D8E4F1;
 border:solid #6699CC 1.0pt'>
 <tr>
  <td style='border:none;padding:.75pt .75pt .75pt .75pt'>
  <p><span lang=EN-GB>The Odm3122.selfhost.de certificates are stored in the IT
  KeePass<u1:p></u1:p></span></p>
  </td>
 </tr>
</table>

<p class=MsoNormal><b><span lang=EN-GB style='font-family:Arial'><u1:p>&nbsp;</u1:p></span></b></p>

<p class=MsoNormal style='margin-bottom:12.0pt'><b><span lang=FR
style='font-family:Arial'>/etc/apache2/site-available/odm3122-ssl.conf</span></b></p>

<p class=MsoNormal><a
href="https://github.com/odm3122/q2_apache_proxy_redirect_ssl_geoip/blob/master/odm3122-ssl.conf"></u1:smarttagtype><u1:smarttagtype namespaceuri="urn:schemas-microsoft-com:office:smarttags" name="place">https://github.com/odm3122/q2_apache_proxy_redirect_ssl_geoip/blob/master/odm3122-ssl.conf</a></p>

<h1><span lang=EN-GB style='font-family:Arial'><u1:p></u1:p>Step 5 Create HTML
Files and parent folders<u1:p></u1:p></span></h1>

<p class=MsoNormal><b><span lang=EN-GB>/var/www/html/en/index.html<u1:p></u1:p></span></b></p>

<p class=MsoNormal><span lang=EN-GB>&lt;!DOCTYPE html PUBLIC &quot;-//IETF//DTD
HTML 2.0//EN&quot;&gt;<br>
&lt;HTML&gt;<br>
&nbsp;&nbsp;&nbsp;&lt;HEAD&gt;<br>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&lt;TITLE&gt;<br>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Hello International Guest<br>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&lt;/TITLE&gt;<br>
&nbsp;&nbsp;&nbsp;&lt;/HEAD&gt;<br>
&lt;BODY&gt;<br>
&nbsp;&nbsp;&nbsp;&lt;H1&gt;Hi&lt;/H1&gt;<br>
&nbsp;&nbsp;&nbsp;&lt;P&gt;This is the International Site.&lt;/P&gt; <br>
&lt;/BODY&gt;<br>
&lt;/HTML&gt;<u1:p></u1:p></span></p>

<p class=MsoNormal><span lang=EN-GB><u1:p>&nbsp;</u1:p></span></p>

<p class=MsoNormal><b><span lang=EN-GB>/var/www/html/fr/index.html<u1:p></u1:p></span></b></p>

<p class=MsoNormal><span lang=EN-GB>&lt;!DOCTYPE html PUBLIC &quot;-//IETF//DTD
HTML 2.0//EN&quot;&gt;<br>
&lt;HTML&gt;<br>
&nbsp;&nbsp;&nbsp;&lt;HEAD&gt;<br>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&lt;TITLE&gt;<br>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Hello <st1:country-region><st1:place>France<br>
</st1:place></st1:country-region>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&lt;/TITLE&gt;<br>
&nbsp;&nbsp;&nbsp;&lt;/HEAD&gt;<br>
&lt;BODY&gt;<br>
&nbsp;&nbsp;&nbsp;&lt;H1&gt;Hi&lt;/H1&gt;<br>
&nbsp;&nbsp;&nbsp;&lt;P&gt;This is the France Site.&lt;/P&gt; <br>
&lt;/BODY&gt;<br>
&lt;/HTML&gt;<u1:p></u1:p></span></p>

<p class=MsoNormal><span lang=EN-GB><u1:p>&nbsp;</u1:p></span></p>

<h1><span lang=EN-GB style='font-family:Arial'><u1:p>&nbsp;</u1:p></span></h1>

<p class=MsoNormal><b>/var/www/html/fr/index.html<u1:p></u1:p></b></p>

<p class=MsoNormal><span lang=EN-GB>&lt;!DOCTYPE html PUBLIC &quot;-//IETF//DTD
HTML 2.0//EN&quot;&gt;<br>
&lt;HTML&gt;<br>
&nbsp;&nbsp;&nbsp;&lt;HEAD&gt;<br>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&lt;TITLE&gt;<br>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Hello <st1:country-region><st1:place>Switzerland<br>
</st1:place></st1:country-region>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&lt;/TITLE&gt;<br>
&nbsp;&nbsp;&nbsp;&lt;/HEAD&gt;<br>
&lt;BODY&gt;<br>
&nbsp;&nbsp;&nbsp;&lt;H1&gt;Hi&lt;/H1&gt;<br>
&nbsp;&nbsp;&nbsp;&lt;P&gt;This is the Swiss Site.&lt;/P&gt; <br>
&lt;/BODY&gt;<br>
&lt;/HTML&gt;<u1:p></u1:p></span></p>

<p><span lang=EN-GB style='font-size:10.0pt;font-family:"Courier New"'><u1:p>&nbsp;</u1:p></span></p>

<h1><a name="_Toc451941910"><span lang=EN-GB style='font-family:Arial'>Step 6:
Enable Virtual Hosts</span></a></h1>

<u1:p></u1:p><pre><span lang=EN-GB># sudo a2ensite duuig duuig-ssl<u1:p></u1:p></span></pre>

<p><span lang=EN-GB>Do not activate the new configuration yet.<u1:p></u1:p></span></p>

<h1><a name="_Toc451941911"><span lang=EN-GB style='font-family:Arial'>Step 7:
Activate new Configuration</span></a></h1>

<u1:p></u1:p>

<p><span lang=EN-GB>First, we check that the configuration is valid.<u1:p></u1:p></span></p>

<pre><span lang=EN-GB># sudo apachectl configtest<u1:p></u1:p></span></pre><pre><span
lang=EN-GB>Syntax OK<u1:p></u1:p></span></pre>

<p><span lang=EN-GB>If the configuration is valid we can reload it<u1:p></u1:p></span></p>

<pre># service apache2 reload</pre><pre><u1:p>&nbsp;</u1:p></pre><pre><u1:p>&nbsp;</u1:p></pre>

<h1><span lang=EN-GB style='font-family:Arial'>Summary<u1:p></u1:p></span></h1>

<p class=MsoNormal><span lang=EN-GB>This is a manual configuration of a Apache
Proxy that redirect User based on there GeoIP.<u1:p></u1:p></span></p>

<p class=MsoNormal><span lang=EN-GB>There is also a Puppet Module für the
Installation of Mod GeoIP  but i didn't found out in a short time as this
module is only blocking or also redirect. Class: </span><code><span lang=EN-GB
style='font-size:10.0pt'>apache::mod::geoip</span></code></p>

<u1:p></u1:p>

<p class=MsoNormal><span lang=EN-GB><u1:p>&nbsp;</u1:p></span></p>

<p class=MsoNormal><span lang=EN-GB><u1:p>&nbsp;</u1:p></span></p>

<p class=MsoNormal><span lang=EN-GB><u1:p>&nbsp;</u1:p></span></p>

<p><span lang=EN-GB>&nbsp;<u1:p></u1:p></span></p>

<p><span lang=EN-GB>&nbsp;<u1:p></u1:p></span></p>

<p class=MsoNormal><span lang=EN-GB><u1:p>&nbsp;</u1:p></span></p>

</div>

</u1:smarttagtype>
</body>

</html>
