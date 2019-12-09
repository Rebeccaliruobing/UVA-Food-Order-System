# Run UVA Food Order System on Windows
## Configure Server
1. Download Xamapp and set configuration files. Tutarial: https://pureinfotech.com/install-xampp-windows-10/
2. Copy source code to \your_download_location\xampp\htdocs\uvafood.
3. Create "foodorder" database in phpmyadmin.
4. Run CreateTable.sql script in "foodorder" database. After doing this, you should see the tables in the database. ![](https://github.com/Rebeccaliruobing/UVA-Food-Order-System.git/master/images/database.PNG)
5. Go to http://localhost:your_localhost_port/uvafood/index.html . You should be able to use the website now. ![](https://github.com/Rebeccaliruobing/UVA-Food-Order-System.git/master/images/index.PNG)

## Use the website
1. Register: Click on register and register an account. Now your account information should be added to the user_info table in the database.
2. Log in: Use the account information you registered to log in.
3. Update personal profile: After logg in, there would be a subpage called User Profile. Go to that subpage and input your information such as address, phone, cardnumber and wallet. Wallet is your recharge amount for this website.
After this step, you could see your updated personal profile in the left column of the "User Profile" subpage.
![](https://github.com/Rebeccaliruobing/UVA-Food-Order-System.git/master/images/update.PNG)
4. Submit an order: Go to subpage "Menu" and order your food. Click on "Shopping Cart" to see what you have ordered and submit the order. If there is no enough food storage or balance in your wallet, you would receive corresponding alert and the order would not be submitted. You can change the food storage in the database through phpmyadmin interface or update the wallet by updateing your profile.
5. Reorder: After successfully submitted a new order, go to "User Profile" subpage and click on "Previous Orders", all of your previous orders will be displayed. Click on the one you want to reorder, and go to "Menu", the food you previously ordered has been added to your shopping cart, and now you could reorder. Click on "Previous Orders" again, all of the previous orders will be displayed.