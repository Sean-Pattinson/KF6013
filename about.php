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
<title>About - Coast City Sport Centre</title>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="scripts/main.js"></script>
<link rel="stylesheet" type="text/css" href="styles/style.css"/>
</head>';

$user = isset($_SESSION['user_name']) ? $_SESSION['user_name'] : 'Login';
$user_pic = isset($_SESSION['profile_pic']) ? $_SESSION['profile_pic'] : NULL;
$logged_in = isset($_SESSION['logged_in']) && $_SESSION['logged_in'] === TRUE ? $_SESSION['logged_in'] : FALSE;

echo "<body>
    <nav class='top'><a href='index.php'>Home</a>
    <a href='element3.php'>Technical Architecture</a>
    <a href='about.php' class='active'>About</a>
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

<h1>Critical Evlauation/Reflection</h1>
<p>    
For this project, I decided to use Azure as my cloud service provider but there are other options available as cloud service providers such as Amazon or google cloud, I decided to go with azure for the assessment due to having a student account with a student subscription for azure whereas in a paid solution I would have still opted to use Azure to host the cloud solution, I would opt for Azure in a paid solution as I believe they offer the most varied solutions required to host and serve a web app, as well as the simplicity of the service, although it is easy to debate that all 3 major cloud providers are fairly easy to use and provide adequate options for organizations that would meet their requirements of moving to cloud-based hosting over a self-hosted solution. If an organization was looking to simply host a web app all 3 major providers offer different solutions that would be suitable for this, AWS offers amplify, Google Cloud offers Firebase Deploy and Azure offers the hosting of Static Web apps, whereas all 3 also offer GitHub implementation which would allow a web app to be stored on GitHub and served by any of the 3 providers. For Coast City Sports Centre purposes, I would opt to use a VM running a LAMP stack to host and serve the web application. </p>

<p>The machine I would  opt to use in a live business application with commercial context would be the D4s_v3 as this offers a VM with 4 vCPUs, 16GiB of ram, and 32GiB temporary storage, this would cost £126.23 a month the B1S that was specified to be used in the original Cloud Solution Specification albeit suitable for the purpose of the assignment it would not be able to meet the requirements specified in Element 3 of Part 2 of the assessment, Although it could be argued that in a commercial solution and using Azure as the cloud service provider you could also opt to use the Web App resource and use the Premium V3 P2V3 which has the capability of 195 ACU/vCPU minimum , as well as 16GiB of memory using this resource, also offers features such as Custom Domains and SSL, an auto scale of up to 30 instances, up to 20 staging slots, daily backups up to a limit of 50 times daily, a traffic manager which would route traffic between multiple instances of the web app, it also has Azure Compute Units included in the hardware, memory per instance configuration and 250GB of storage included. Using the P2V3 SKU would cost £195 a month to run the instance as well as the cost of any additional storage being required which could utilize the Azure CDN which would allow publicly available content to be delivered faster and at lower latency, for a database a choice of Azure SQL Database or Cosmos DB could be used where Cosmos would be best in a non-relational database setting and SQL would be best suited to relational data. Azure Active directory could also be utilized for the management of user access and the control of not only access to the app but also the permissions within the web application. Since 30 instances can be run simultaneously, this should be more than enough to cope with the Peak Load of 50Gbps on event days and the 10Mbps on the subsequent leading and trailing days of an event. </p>

<p>If it is opted to use the web app resource, several other resources can be run alongside such as Azure front door which allows ‘secure access between your users and your applications’ static and dynamic web content across the globe’ ("Scalable web application - Azure Reference Architectures", 2022), Azure Front Door allows load-balancing for HTTP(S) Traffic whereas Traffic Manager is recommended for the global load balancing of non-HTTP(S) Traffic. The solution in a commercial context would still be hosted in the UK as this will ensure that necessary GDPR regulations are followed rather than storing data in a different country which could cause various legal and ethical issues. The technical architecture that the application will be run on will still be a LAMP stack as I believe this is the most suitable for the serving of web applications.</p>

<p>For the technologies used in the development of this solution, I opted for PHP, HTML5, and jQuery to use as the frameworks for the application whereas if I was to replicate it in a commercial context I would opt to use Node.js and React as I find that both are extremely easy to use and scale up as applications grow but for the purpose of the assignment I decided it would be best to use a more vanilla solution as the scope of the application was not complex or large enough to justify using libraries such as Node and React as the implementation of the jQuery Library and Abraham twitteroauth was more than enough to enable the application to function as desired and work as necessary.</p>

<p><h3>References</h3>
<p>Cloud Pricing Comparison for 2022: AWS vs. Azure vs. Google Cloud Platform - CAST AI. (2022). Retrieved 2 June 2022, from https://cast.ai/blog/cloud-pricing-comparison-aws-vs-azure-vs-google-cloud-platform/</p>
<p>Google Maps Overlays. (2022). Retrieved 2 May 2022, from https://www.w3schools.com/graphics/google_maps_overlays.asp</p>
<p>HTML Web Storage API. (2022). Retrieved 2 May 2022, from https://www.w3schools.com/html/html5_webstorage.asp</p>
<p>Krutz, R., & Vines, R. (2016). Cloud security. New Delhi: Wiley.</p>
<p>Kant, K., & Won, Y. (1999). Server capacity planning for Web traffic workload. IEEE Transactions On Knowledge And Data Engineering, 11(5), 731-747. doi: 10.1109/69.806933</p>
<p>Li, A., Yang, X., Kandula, S., & Zhang, M. (2010). CloudCmp. Proceedings Of The 10Th Annual Conference On Internet Measurement - IMC '10. doi: 10.1145/1879141.1879143</p>
<p>Load-balancing options - Azure Architecture Center. (2022). Retrieved 2 June 2022, from https://docs.microsoft.com/en-us/azure/architecture/guide/technology-choices/load-balancing-overview?toc=%2Fazure%2Ffrontdoor%2Fstandard-premium%2Ftoc.json</p>
<p>Peng, J., Zhang, X., Lei, Z., Zhang, B., Zhang, W., & Li, Q. (2009). Comparison of Several Cloud Computing Platforms. 2009 Second International Symposium On Information Science And Engineering. doi: 10.1109/isise.2009.94</p>
<p>Qu, L., Wang, Y., & Orgun, M. (2013). Cloud Service Selection Based on the Aggregation of User Feedback and Quantitative Performance Assessment. 2013 IEEE International Conference On Services Computing. doi: 10.1109/scc.2013.92</p>
<p>Scalable web application - Azure Reference Architectures. (2022). Retrieved 2 June 2022, from https://docs.microsoft.com/en-gb/azure/architecture/reference-architectures/app-service-web-app/scalable-web-app</p>
<p>Tianfield, H. (2012). Security issues in cloud computing. 2012 IEEE International Conference On Systems, Man, And Cybernetics (SMC). doi: 10.1109/icsmc.2012.6377874</p>

</article>
</main>

</body>
</html>

