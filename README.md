## About This App

This application allows to manage private post offices and also is an e-commerce app, built from scratch. It is build using Laravel, MySQL, Bootstrap 4, SASS and JS.

In following lines you will see examples how application looks when ran.

## Home Page
As you can see from home page there are availabe multiple links, like Track Order, Login, Register etc, and also there's an image slider 

![](/ApplicationScreenshots/0.png)


## Product Cards And Filtering
Product Cards are nicely designed with SASS and also there is option to filter products based on their category

![](/ApplicationScreenshots/1.png)


## Procduct Details
Clicking View button at any Card, opens following page which shows different data about that specific product.

![](/ApplicationScreenshots/2.png)


## Track Order
There's also an option to track order. This option allows buyers to track their order with phone numer and tracking id, which is sent to users with email

![](/ApplicationScreenshots/3.png)


## Search With Algolia
All products can be searched from search bar, using Algolia plugin (this option may not directly work, because Algolia offers only 14-days free trial. You may sign up for free trial in [Algolia](https://www.algolia.com/users/sign_up), and then make sure to configure env file properly)

![](/ApplicationScreenshots/4.png)


## Multi role authentication
Four (4) types of users can login: Admin, Seller, Buyer and Post Office Employee. Login form is shown in following screenshot, and similar form is register form also.

![](/ApplicationScreenshots/5.png)


## Admin Chooses Employee To Complete Order Delivery
Admin can choose which employee to complete delivery

![](/ApplicationScreenshots/6.png)


## Admin Can Manage Clients (Sellers) Or Search For Them (Local Search, Algolia Not Used In This Example)
Admin has different option with which he can manage client accounts like seeing all client orders, disabling their account (is client is logged in he will automatically be kicked out of his account, otherwise login will not be permitted) or completely deleting their account

![](/ApplicationScreenshots/7.png)


## Seller Can See His Order
All sellers can see orders made to them, and different info about each order, like if it is purchased, delivered etc.

![](/ApplicationScreenshots/8.png)


## Seller Can Add Products
Seller can add products (and also edit/delete them). Following form shows how user can add products.

![](/ApplicationScreenshots/9.png)


## Each Buyer Has His Cart
Buyers can add products to cart, change amount or completely remove them from cart. Price for each product and total price are calculated with JS. 

![](/ApplicationScreenshots/10.png)


## Purchase Products With Stripe
Integrated in application is Stripe, a service that allows transactions from web pages.

![](/ApplicationScreenshots/11.png)


## Post Employee Can Mark Orders As Delivered
Lastly each post employee can see orders that he/she needs to deliver, and can mark them as delivered.

![](/ApplicationScreenshots/12.png)


## More 
There are other options in this app, however only a few most important have been featured. You can download and run this app to see all of those options.

... and don't forget to import some products to try out all functionalities!
