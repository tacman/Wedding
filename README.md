Survos Standard Edition
========================

Welcome to the Survos Standard Edition, based on the
Symfony Standard Edition - a fully-functional Symfony2
application that you can use as the skeleton for Survos applications.


### Clone the git Repository

We highly recommend that you download the packaged version of this distribution.
But if you still want to use Git, you are on your own.

Run the following commands:

    cd /usr/sites/sf
    git clone http://github.com/Survos/survos-standard.git <new_app>
    cd <new_app>
    rm -rf .git OR rmdir /S .git

2) Installation
---------------

Once you've downloaded the standard edition, installation is easy, and basically
involves making sure your system is ready for Symfony.

### a) Check your System Configuration

Before you begin, make sure that your local system is properly configured
for Symfony. To do this, execute the following:

    php app/check.php

If you get any warnings or recommendations, fix these now before moving on.

### b) Install the Vendor Libraries

If you downloaded the archive "without vendors" or installed via git, then
you need to download all of the necessary vendor libraries. If you're not
sure if you need to do this, check to see if you have a ``vendor/`` directory.
If you don't, or if that directory is empty, run the following:

    php bin/vendors install

Note that you **must** have git installed and be able to execute the `git`
command to execute this script. If you don't have git available, either install
it or download Symfony with the vendor libraries already included.

### c) Access the Application via the Browser

Congratulations! You're now ready to use Symfony. If you've unzipped Symfony
in the web root of your computer, then you should be able to access the
web version of the Symfony requirements check via:

    http://<new_app>.localsite.us/app_dev.php

If everything looks good, click the "Bypass configuration and go to the Welcome page"
link to load up your first Symfony page.

You can also use a web-based configurator by clicking on the "Configure your
Symfony Application online" link of the ``config.php`` page.

To see a real-live Symfony page in action, access the following page:

    web/app_dev.php/demo/hello/Fabien


* Twig is the only configured template engine;
* Propel is configured;
* Swiftmailer is configured, and turned off in config_dev.yml (Windows bug)
* Annotations for everything are enabled.

A default bundle, ``AcmeDemoBundle``, shows you Symfony2 in action. After
playing with it, you can remove it by following these steps:

* delete the ``src/Acme`` directory;
* remove the routing entries referencing AcmeBundle in ``app/config/routing_dev.yml``;
* remove the AcmeBundle from the registered bundles in ``app/AppKernel.php``;

An admin generator is also included.  The default data is taken from
the Application Generator at

https://github.com/cedriclombardot/AdmingeneratorIpsum


Enjoy!
