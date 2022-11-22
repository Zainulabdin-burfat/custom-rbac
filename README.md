<h2>Laravel 8 - Role Based Access Control</h2>

<h3>Custom Route Wise Access Control</h3>

<p>2 Authorization layers, the one is using Gates and Policies, and the second is using custom command route wise using route name eg: (post.index, post.create)</p>

<h3>Prerequisites</h3>
<li>Laravel 8</li>
<li>php >= 7.3</li>


<h3>Commands</h3>
<h5>php artisan migrate</h5>
<h5>php artisan db:seed</h5>
<h5>php artisan create:permission</h5>
<p>Permissions are created dynamically through command according to the controllers having methods</p>


<b>Admin login credentials</b>
<br>
<li>email=admin@admin.com</li>
<li>password=password</li>
