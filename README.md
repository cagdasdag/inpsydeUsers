# Inpsyde Test Project

**Applicant Name:** Çağdaş Dağ

**Applicant Email:** cagdasdag81@gmail.com

# Installation
```shell
$ cd <your_wordpress_path>/wp-content/plugins
$ git clone https://github.com/cagdasdag/inpsydeUsers.git
$ cd inpsydeUsers/
$ composer update
```

### Development
If you want to build assets (minified CSS and js files) you need to run
```shell
$ npm install
$ gulp
```
Or if you want to watch CSS changes you can use
```shell
$ gulp watch
```


# Unit Tests
```shell
$ vendor/bin/phpunit
```

# Codestyle Checks
```shell
vendor/bin/phpcs --standard="Inpsyde" ./
```

## Possible questions I want to answer

- [Is there any customization option](#is-there-any-customization-option)
- [Which frontend technologies are used and why](#which-frontend-technologies-are-used-and-why)
- [What kind of extras I made](#what-kind-of-extras-i-made)
- [Is there any cache for requests](#is-there-any-cache-for-requests)
- [Why plugin doesn't contain too many unit tests](#why-plugin-doesnt-contain-too-many-unit-tests)

### Is there any customization option

We have an options page on the WordPress admin side. You can check in /wp-admin/options-general.php?page=inpsyde-users
There is only one input and you can change the custom URL slug with this. 

### Which frontend technologies are used and why

I've used SASS to write CSS because I think plain CSS would be harder to read.
I've used Gulp to compile SASS to CSS and minify all CSS and js files. Also, I've used jQuery to send AJAX requests and show/hide popup.

### What kind of extras I made

- Endpoint is customizable via the options page.
- The plugin is using several hooks to extend functionality.
- If you create an inpysde-templates folder in your theme, you can override the user listing table and popup.

### Is there any cache for requests

I've used 2 types of cache. First of all, when you click on one of the rows it is sending an AJAX request to the backend on initial click. And when you click again it is not sending a new request to the backend. It is getting data from the previous click. That's opens all the details faster when on the second click.

Also when the plugin sent a request to API and if it is successful, it is creating a temporary transient. So when there is an existing transient for this request it is not sending a request to the 3rd API, it is getting data from the database. 

### Why plugin doesn't contain too many unit tests?

I want to reply to this question especially. Because I spent ~3 hours to find a test case but couldn't find it. Maybe I couldn't imagine which cases I should test because I'm not good at tests. Because the project is not big and most of the methods should contain WordPress functions. It doesn't make sense to me to write if this function exists if this filter exists and so on. That's why I couldn't write a lot of tests. 
