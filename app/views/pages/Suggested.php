<?php

class Suggested extends View{
    public function output(){
        $title = $this->model->title;
        require_once APPROOT . "/views/inc/header.php";
        ?>
        <html lang>
        <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Suggested form</title>
        <link rel="stylesheet" href="<?php echo URLROOT. "css/SuggestedStyle.css" ?>">
        </head>
        <body>
        <div class="container">
            <h2 class="title">
                <span>Your Opinion</span>
                <span class="title-word title-word-3">Matters</span>
            </h2>
        </div>
      <div class="testbox">
      <form action="/">
        <h3><b>Overall experience with our service</b></h3>

        <table>
          <tr>
            <th class="first-col"></th>
            <th>Very Good</th>
            <th>Good</th>
            <th>Fair</th>
            <th>Poor</th>
            <th>Very Poor</th>
          </tr>
          <tr>
            <td class="first-col">How would you rate your overall experience with our service?</td>
            <td><input type="radio" value="none" name="rate" /></td>
            <td><input type="radio" value="none" name="rate" /></td>
            <td><input type="radio" value="none" name="rate" /></td>
            <td><input type="radio" value="none" name="rate" /></td>
            <td><input type="radio" value="none" name="rate" /></td>
          </tr>
          <tr>
            <td class="first-col">How satisfied are you with the comprehensiveness of our offer?</td>
            <td><input type="radio" value="none" name="satisfied" /></td>
            <td><input type="radio" value="none" name="satisfied" /></td>
            <td><input type="radio" value="none" name="satisfied" /></td>
            <td><input type="radio" value="none" name="satisfied" /></td>
            <td><input type="radio" value="none" name="satisfied" /></td>
          </tr>
          <tr>
            <td class="first-col">How would you rate our prices?</td>
            <td><input type="radio" value="none" name="prices" /></td>
            <td><input type="radio" value="none" name="prices" /></td>
            <td><input type="radio" value="none" name="prices" /></td>
            <td><input type="radio" value="none" name="prices" /></td>
            <td><input type="radio" value="none" name="prices" /></td>
          </tr>
          <tr>
            <td class="first-col">How satisfied are you with the customer support?</td>
            <td><input type="radio" value="none" name="name" /></td>
            <td><input type="radio" value="none" name="name" /></td>
            <td><input type="radio" value="none" name="name" /></td>
            <td><input type="radio" value="none" name="name" /></td>
            <td><input type="radio" value="none" name="name" /></td>
          </tr>
          <tr>
            <td class="first-col">Would you recommend our product / service to other people?</td>
            <td><input type="radio" value="none" name="recommend" /></td>
            <td><input type="radio" value="none" name="recommend" /></td>
            <td><input type="radio" value="none" name="recommend" /></td>
            <td><input type="radio" value="none" name="recommend" /></td>
            <td><input type="radio" value="none" name="recommend" /></td>
          </tr>
        </table>
        <h4><b>What should we change in order to live up to your expectations?</b   ></h4>
        <textarea rows="5"></textarea>
        <div class="btn-block">
          <button type="submit" href="/">Send Feedback</button>
        </div>
      </form>
    </div>
        </body>
        </html>
        <?php
    }
}
?> 