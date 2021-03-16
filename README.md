<h1>c1x1-Helpdesk</h1>

<h2>Installation</h2>

<h3>Via Git</h3>
<ol>
    <li><code>"C1x1\\Helpdesk\\": "package/helpdesk/src"</code> to <code>psr-4</code></li>
    <li><code>composer install</code></li>
    <li><code>C1x1\Helpdesk\HelpdeskServiceProvider::class</code> to <code>'config/app.php' $providers</code></li>
    <li><code>composer vendor:publish</code></li>
</ol>

<h3>via Composer</h3>
<ol>
    <li><code>composer require c1x1/helpdesk</code></li>
    <li><code>composer install</code></li>
    <li><code>C1x1\Helpdesk\HelpdeskServiceProvider::class</code> to <code>'config/app.php' $providers</code></li>
    <li><code>composer vendor:publish</code></li>
</ol>
