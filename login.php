<?php

header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache");


  // error reporting
  
  error_reporting(E_ALL);
  ini_set('display_errors', 1);
    // Starting session

    session_start();
    $userid = $_SESSION['userid'];
   
  // Import functions
  require_once('validationOwnPage.php');

  // Validate form submission
  validate();
 ?>

<!DOCTYPE html>
<html id="funnyBack">
  <head>
      
    <meta charset="utf-8"  name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Financial Project</title>
    <link rel="stylesheet" href="style.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script>
        //function to load table and balance
        function loadTransactionsTable(filter) {
            $("#transactionsBody").load("validationOwnPage.php?filterCategory=" + filter, function(result) {
                 //jquery for populate balance
                $(".showBalance").load("validationOwnPage.php?showBalance=" + filter, function(result){
                
                });

            });
        }
        //jquery for populate filterCategory
        $(document).ready(function() {

            $("#filterCategory").keyup(function(event){
                var filter = $("#filterCategory").val();
                if (filter != '' && filter.length >= 3) {
                    loadTransactionsTable(filter);
                } else {
                    loadTransactionsTable('');
                }
            });
            loadTransactionsTable('');
        });
       
    </script>
  </head>

  <body style="background-color:AliceBlue;">
    <div class="financialMain">
        <div class="hello"> 
        <h1><?php populateUserName() ?> </h1>
        </div>
        <h1>Financial Plan</h1>
        <div id="financialControl">
            <div id="category">
                <h2>New Category</h2>
               
                <form action="login.php" method="post">
                    <label>
                        Enter name of new category:
                        <input type="text" value=''  name="category" />
                    </label>
                    <?php the_validation_message('category'); ?>
                    <input type="submit" value="Submit Category" name="submitCategory" />
                </form>
            </div>
            <div id="transactions">
                <h2>New Transactions</h2>
                <form action="login.php" method="post">
                    <label>
                        Value:
                        <input type="text" value='' name="value"/>
                        <?php the_validation_message('value'); ?>
                    </label>
                    <label>
                        Description:
                    </label>
                        <input type="text" value='' name="description"/>
                        <?php the_validation_message('description'); ?>
                    <label>
                        Category:
                        <select role="menu" aria-haspopup="true" aria-controls="main-menu" aria-labelledby="menu-button" id="listbox1" name="categoryTran[]">
                        <option value='' role="menuitem"  tabindex="-1">None</option>
                        <?php populateCategory(); ?>
                        </select>
                        <?php the_validation_message('categoryTran'); ?>
                    </label>
                    <label>
                        Type:
                        <select  role="menu" aria-labelledby="menu-button" id="menuTypeTransactions" name="type[]">
                            <option  role="menuitem2"  value=''>None</option>
                            <option  role="menuitem2"  value='Credit'>Credit</option>
                            <option  role="menuitem2"  value='Debit'>Debit</option>
                        </select>
                        <?php the_validation_message('type'); ?>
                    </label>
                    <input type="submit" value="Submit Transaction" name="submitTransaction"/>
                </form>
            </div>
            <div class='balance'>
                <div>
                    <h1>Banlance:</h1>      
                    <h1 class="showBalance"><h1>           
                      
                   
                </div>
                <div class="showTransaction">
                        <h1 class="filterCategoryTitle">Filter for Category</h1>
                        <form action="login.php" method="post">
                            
                            <input type="text"  id="filterCategory" placeholder="Search for category"/>
                           
                        </form>
                        
                </div>
                <div class="mainTable"> 
                    <table class="filterTable">
                        <thead>
                            <tr>
                                <th>Transaction Category</th>
                                <th>Transaction Decription</th>
                                <th>Value</th>
                            </tr>                        
                        </thead>
                        <tbody id="transactionsBody">

                        </tbody>
                    </table> 
                </div>
            </div>
        </div>
    </div>
  </body>
</html>