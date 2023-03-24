<!DOCTYPE html>
<html>
<head>
	<title>Help Page</title>
	<link rel="stylesheet" href="./styles/mainstyles.css">
    <link rel="stylesheet" href="./styles/login_create_styles.css">
	<script src="script.js"></script>
</head>
<body style="background-image:url('./styles/background.jpg')">
    <nav>
    <a class="navitem" href="profile.php">Back to Profile</a>
    <a class="navitem" href="market/market.php">Market</a>
    <a class="navitem" href="postgig.php">Post a GIG</a>
    </nav>
	<main style="margin : 1% ;padding:2%;background-color:lightgreen;color:green">
		<h2>Frequently Asked Questions</h2>
		<ul class="dropdown">
			<li>
				<h3>How do I post an Add?</h3>
				<div id="answer">
                    <img src="uploads\help\gig_menu.png" alt="">
                    <p>go to "Gig Post" on Navbar then you can post any number of Adds under 30$</p>
                </div>
			</li>
			<li>
				<h3>What payment methods do you accept?</h3>
				<div id="answer">
                    <p>We Accept all type of credit and Debit cards. also Paypal</p>
                </div>
			</li>
			<li>
				<h3>How do I change my User Details?</h3>
				<div id="answer">
                    <img src="uploads\help\edit_profile.png" alt="">
                    <p>You can use "Edit Profile" button on your Profile</p>
                </div>
			</li>
		</ul>
        
	</main>
        <h3 style="margin : 0 0 2% 1%;">for further questions Contact Us</h3>
        <a  class='navitem' style="background-color:blue; color:white; padding:1%; margin-top: 1%; margin-left:1%" href="mailto:example@example.com" class="email-button">Email Us</a>
    <style>
                header {background-color: #333;color: #fff;padding: 20px;}
                header h1 { margin: 0;}
                main {padding: 20px;}
                h2 {margin-top: 0;}
                ul {list-style-type: none;padding: 0;}
                li {margin-bottom: 20px;}
                h3 { margin-top: 0;cursor: pointer;}
                #answer { display: none; background-color:white; padding:2%; position: relative;}
                img {width:25%}
                #answer p {margin-left: 50px;}

    </style>
    <script>
                // Get the dropdown element
        var dropdown = document.querySelector('.dropdown');

        var dropdownItems = dropdown.querySelectorAll('li');

        dropdownItems.forEach(function(item) {

        var title = item.querySelector('h3');
        var content = item.querySelector('#answer');

        content.style.display = 'none';

        title.addEventListener('click', function() {

            if (content.style.display === 'none') {
            content.style.display = 'block';
            } else {
            content.style.display = 'none';
            }
        });
        });
    </script>

</body>
</html>