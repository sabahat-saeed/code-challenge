# Laravel Code Challenge

This code test involves the creation of a working project with the help of the Laravel framework.
The task is split into three sub-categories and shouldn't take longer than 2-4 hours of your time.

### Prerequisites
This code challenge does not involve any use of database connections. Therefore, you can clone this repository and run it locally as long as you have php >= 7.1.3 installed on your machine. Alternatively, you can install a VM such as Homestead.

1. Option (php cli)
- On Debian/Ubuntu machines, you can simply install everyting needed via apt, given you have the correct apt repository configured:
    - `sudo add-apt-repository -y ppa:ondrej/php`    
    - `sudo apt install composer php7.3-common php7.3-cli php7.3-json php7.3-mbstring php7.3-xml php7.3-opcache php7.3-readline php7.3-pdo php7.3-ctype php7.3-bcmath`
    - Open a terminal and clone this repository into any directory on your machine, then and run `composer install` and `php artisan serve --port=8888` to start the web server, reachable under `http://localhost:8888`
2. Option (Homestead)
- For this, you need to have a hypervisor installed on your machine, such as vmware, virtualbox, parallels or hyper-v. We recommend to install the free [Virtual Box](https://www.virtualbox.org/wiki/Downloads). If you choose to use a different hypervisor, please edit the Homestead.yaml file accordingly ("provider")
- In order for the custom domain **homestead.test** to work, you need to add it to your hosts-file (usually under /etc/hosts): `192.168.99.99 homestead.test`. For a quick fix run `sudo sh -c 'echo "192.168.99.99 homestead.test" >> /etc/hosts'` in your terminal.
- Now you clone this repository and simply run the command `vagrant up`, then `vagrant ssh -c "cd ~/code; composer install"` and your application will be available under the address http://homestead.test

### Restrictions and Requirements
1. Please do **NOT** use any JS/AJAX to solve this challenge but build it in PHP. 
1. Please do **NOT** use any Spotify-Specific libraries but use an API-agnostic library such as [Guzzle](http://docs.guzzlephp.org/en/stable/) or [HTTPlug](http://docs.php-http.org/en/latest/httplug/tutorial.html)
1. This challenge doesn't focus on the UI. Do not spend too much time on layout/css.
1. You should focus on code quality and structure. If possible and timely reasonable, also add tests.
1. Wherever possible and reasonable, try to follow the [SOLID principles](https://en.wikipedia.org/wiki/SOLID)

### The Challenge
Implement the following functionality by using the official Spotify Developer's API. You can create an account [here](https://developer.spotify.com/dashboard/). Find out how to use their API in order to fulfill the implementation goals.

1. Allow your application to communicate with the Spotify API via server-to-server communication. Implement Authentication against their API and the retrieval of an access token that can be used for further requests. ([Reference](https://developer.spotify.com/documentation/general/guides/authorization-guide/#client-credentials-flow))

1. When a user searches for any term in the search box (see `index.blade.php`), the result should be three separate lists: one list with matching artists, one with matching albums and one with tracks.

1. Each result in the lists should consist of an image and a title (name of artist, album or track respectively). Each result should be clickable and lead to another page which contains some more detailed information about the clicked item.


### Hints
We already created the two routes `/` and `/search` which point to the controller methods `index` and `search` which respectively return the views `index.blade.php` and `search.blade.php`.

This repository has been set up for you to start right away. In case you are not familiar with Laravel, here a few hints:
- The routes can be found and configured in the file `routes/web.php`.
- A first controller can be found here: `app/Http/Controllers/SearchController.php`.
- The views can be found under `resources/views`.
- Publicly accessible assets can be placed into the `public/` folder and its sub-directories.
