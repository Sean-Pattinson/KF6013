<?php
require "config.php";
require "vendor/autoload.php";
use Abraham\TwitterOAuth\TwitterOAuth;

session_start();
if(!isset($_SESSION['request_token']) && !isset($_SESSION['username']) && $_SESSION['logged_in'] !== TRUE) {
    session_destroy();
    header('Location: twitter_oauth.php');
}

echo '<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Technical Architecture - Coast City Sport Centre</title>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="scripts/main.js"></script>
<link rel="stylesheet" type="text/css" href="styles/style.css"/>
</head>';

$user = isset($_SESSION['user_name']) ? $_SESSION['user_name'] : 'Login';
$user_pic = isset($_SESSION['profile_pic']) ? $_SESSION['profile_pic'] : NULL;
$logged_in = isset($_SESSION['logged_in']) && $_SESSION['logged_in'] === TRUE ? $_SESSION['logged_in'] : FALSE;

echo "<body>
    <nav class='top'><a href='index.php'>Home</a>
    <a href='element3.php' class='active'>Technical Architecture</a>
    <a href='about.php'>About</a>
    <div class='login_container'>";
    
    if($logged_in === TRUE) {
       $content = '<a href="logout.php" id="login" title="Logout">Hi @'.$user;
    } else {
        $content = '<a href="twitter_oauth.php" id="login" title="Login">'.$user;
    }
        echo $content."</a></div></nav>";

?>

<main>

<article>
<h1> Technical Architecture for Coast City Sports Centre</h1>
<p>    
The technical architecture that I propose for Coast City Sports Centre would be as follows, the main server will be using a Linux based operating system, with 2 CPUs with 16 cores per CPU as week as 128GB of RAM, and the second server will serve as a backup server which will serve as an overflow for traffic that exceeds the capacity of the main web server this will be another Linux based server with 2 CPUs both with 8 Cores each as well as 64GB of RAM.
 There will also be a standalone database server that will host a MySQL database running on a Linux Kernel this server will have processors with 8 cores each 128GB of ram. The final piece of the architecture will be a Storage server which will have the capacity for 100TB of data, 50TB of Back-Up storage, and 50TB of Archive storage. Using Microsoft Azure’s Total Cost of Ownership calculator, it is estimated that switching to a hosted solution could save up to £410,000 over a timeframe of 5 years, this saving is since certain costs are removed from the equation such as data centre, networking and Labour costs.</p>

<p>There is also a lower start-up cost and operating costs if a cloud-based solution was to be employed over a self-hosted solution as a cloud-based solution removes the need for an IT administrator on-premises and removes the costs of running and maintaining the physical hardware on-site, on these items alone there can be a saving of up to over £300,000. A cloud-based solution would be more suitable for smaller organizations that perhaps don’t already have the infrastructure in place or are physically not able to host the infrastructure required to serve a web application, database servers, and storage requirements of the business. There is also a saving to be seen in software licensing costs when an organization switches to a cloud-based solution if they are self-hosting the solution there are licensing costs for the software required in hosting a SQL database on-premises.</p>

<p>I believe that cloud-based solutions also offer the chance for smaller organizations to access technologies that they may be unable to attain in an on-premises solution or hosted solution where this could be down to the cost of implementing a physical solution in order to meet the requirements of the business, there is also an argument to be made that a cloud-based solution can be upgraded seamlessly or on the fly and can provide more flexibility when it comes to making quick changes to the architecture required for the business, whereas for a Physical solution new hardware or software would need to be procured if the businesses need or requirements were to change as well as the time and man-hours that would need to be used to facilitate the upscaling and upgrade of the physical architecture of the business.</p>

<p><h3>References</h3>
<p>Birrittella, M., Debbage, M., Huggahalli, R., Kunz, J., Lovett, T., & Rimmer, T. et al. (2016). Enabling Scalable High-Performance Systems with the Intel Omni-Path Architecture. IEEE Micro, 36(4), 38-47. doi: 10.1109/mm.2016.58</p>
<p>Chieu, T., Mohindra, A., Karve, A., & Segal, A. (2009). Dynamic Scaling of Web Applications in a Virtualized Cloud Computing Environment. 2009 IEEE International Conference On E-Business Engineering. doi: 10.1109/icebe.2009.45</p>
<p>Gibson, G., Nagle, D., Amiri, K., Butler, J., Chang, F., & Gobioff, H. et al. (1998). A cost-effective, high-bandwidth storage architecture. ACM SIGOPS Operating Systems Review, 32(5), 92-103. doi: 10.1145/384265.291029</p>
<p>IaaS: Web app with relational database - Azure Reference Architectures. (2022). Retrieved 2 June 2022, from https://docs.microsoft.com/en-gb/azure/architecture/high-availability/ref-arch-iaas-web-and-db</p>
<p>Kant, K., & Won, Y. (1999). Server capacity planning for Web traffic workload. IEEE Transactions On Knowledge And Data Engineering, 11(5), 731-747. doi: 10.1109/69.806933</p>
<p>Li, K., & Jamin, S. A measurement-based admission-controlled Web server. Proceedings IEEE INFOCOM 2000. Conference On Computer Communications. Nineteenth Annual Joint Conference Of The IEEE Computer And Communications Societies (Cat. No.00CH37064). doi: 10.1109/infcom.2000.832239</p>
<p>Total Cost of Ownership (TCO) Calculator | Microsoft Azure. (2022). Retrieved 2 June 2022, from https://azure.microsoft.com/en-gb/pricing/tco/calculator/</p>
<p>Why Azure—Cloud Innovation to Meet Any Challenge | Microsoft Azure. (2022). Retrieved 2 June 2022, from https://azure.microsoft.com/en-gb/overview/why-azure/</p>
</article>
</main>

</body>

</html>

