<?php
  print("Entering findClient.php");
  session_start();
  $errMsg = $_REQUEST['errMsg'];
  //print ("errMsg = " . $errMsg);
  
  $clientList = $_SESSION['clientList'];

  $contactInfo = $_SESSION['contactInfo'];
  
  $size = sizeof($clientList);
  $index1 = $_SESSION['index1'];
  if ( $index1 == "" ) $index1 = 0;

  $current = $_SESSION['current'];

  print ("size = " . $size);

  $temp = $_REQUEST['index1'];
  if (  $temp != "" ) {
     $index1 = $temp;
     $_SESSION['current'] = $temp;
     $_SESSION['index1'] = $temp;
     print ("index1 at ENTRY = " . $index1);

     $contactInfo = $clientList[$index1];       //get current contactInfo
     //$_SESSION['contactInfo'] = $contactInfo;
  }

      $action = $_REQUEST['action'];
      print ("action = " . $action);

      if ( $action != "" ) {
		 if ( $action == "Find Now" )
       		$index1 = 0;
     	 else
     	 if ( $action == "current" )
     	    $index1 = $current;
     	 else
	     if ( $action == "previous" && $index1 > 0 )
	        $index1--;
     	 else
     	 if ( $action == "next" && $index1 < $size-1 ) {
     	    $index1 = $index1 + 1;
         }
     	 else
	     if ( $action == "Clear Entries" )
	     {
			 print("CLEARINGGGGGGGGGGGGGG clientInfo");
			 $contactInfo = "";
			 $_SESSION['contactInfo'] = $contactInfo;
             $clientList = "";
             $_SESSION['clientList'] = $clientList;
		 }

            $_SESSION['index1'] = $index1;
            print("index1 after NEXT = " . $index1);
            $contactInfo = $clientList[$index1];       //get current contactInfo
            $_SESSION['contactInfo'] = $contactInfo;
      }
?>
<html>
<head>
  <title></title>
  <style type="text/css">

  </style>
    <link href="mws.css" rel="stylesheet" type="text/css">
</head>
<body  text="#524020" link=""#524020" vlink="#524020" alink="#524020"><div class="fsize">

<a href="main.php">Home</a>  &nbsp&nbsp&nbsp

<a href="findClient.php?action=Clear Entries">Clear Entries</a> <br>


<font color="BLUE">Size:<?php echo $size; ?> &nbsp&nbsp index1:<?php echo $index1; ?> </font><br>

<font color="red">
  <?php echo $errMsg; ?>
</font>

<form action="SearchClientServlet.php" method="post">

<input type="submit" value="Find Now" name="action" method="post" >
<input type="submit" value="Use Client" name="action" method="post">

<input type="submit" value="Update Client" name="action" method="post" >

<input type="submit" value="Create Client" name="action" method="post" >

<input type="submit" value="Auto Create" name="action" method="post" >

<br><br>

<a href="findClient.php?action=current">CURRENT</a> &nbsp&nbsp
<a href="findClient.php?action=previous">PREVIOUS</a>
<a href="findClient.php?action=next">NEXT</a> &nbsp&nbsp

<?php

  if ( $errMsg == "clientNotFound" ) { ?>
   <font color="red">Client NOT FOUND</font>
<?php } else if ( $errMsg == "insertFail" ) { ?>
   <font color="red">Create Client Failed (Duplicate Client Number or client field is null)</font>
<?php } ?>

<table width="700">
  <tr>
    <td colspan="3" align="center">
      <h1><font color="blue"><b>Find Client</b></font></h1>
    </td>
  </tr>

<!--1st ROW -->

<!--2nd ROW -->
  <tr>
    <td width= ><b>Client:</b>
      <input type="text" size="6" name="client" value="<?php echo $contactInfo['client']; ?>">
    </td>
    <td width= ><b>ResaleNum:</b>
      <input type="text" size="15" name="resaleNum" value="<?php echo $contactInfo['resaleNum']; ?>">
    </td>
    <td width= ><b>SalesRep:</b>
      <input type="text" size="15" name="salesRep" value="<?php echo $contactInfo['salesRep']; ?>">
    </td>

  </tr>

<!--3rd ROW -->

<!--4th ROW -->

  <tr>
    <td colspan="2" class="BIG"><b>Company:</b>
          <input type="text" class="BIG" size="30" name="companyName" value="<?php echo $contactInfo['companyName']; ?>">
    </td>
    <td><b>Contact:&nbsp&nbsp&nbsp&nbsp</b>
      <input type="text" size="30" name="contact" value="<?php echo $contactInfo['contact']; ?>">
    </td>
  </tr>

<!--5th ROW -->

  <tr class="smaller">
    <td ><b>Address:&nbsp&nbsp</b>
      <input type="text" size="30" name="streetAddress" value="<?php echo $contactInfo['streetAddress']; ?>">
    </td>
    <td><b>Phone:&nbsp</b>
      <input type="text" size="18" name="businessPhone" value="<?php echo $contactInfo['businessPhone']; ?>">
    </td>
    <td >
        <b>Fax:&nbsp</b>
        <input type="text" size="18" name="faxPhone" value="<?php echo $contactInfo['faxPhone']; ?>">
        <b>Cell:&nbsp</b>
        <input type="text" size="18" name="cellPhone" value="<?php echo $contactInfo['cellPhone']; ?>">
  </td>
  </tr>
<!--6th ROW -->

  <tr>
    <td  ><b>City:&nbsp</b>
      <input type="text" size="20" name="city" value="<?php echo $contactInfo['city']; ?>">
    </td>

    <td>
     <b>State:</b>
      <input type="text" size="2" maxlength="2" name="state" value="<?php echo $contactInfo['state']; ?>">
    </td>

    <td><b>Zip Code:</b>
        <input type="text" size="10" name="zipCode" value="<?php echo $contactInfo['zipCode']; ?>" >
    </td>
  </tr>
</table>
</form>

