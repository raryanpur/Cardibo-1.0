$(document).ready(function(){

		var privacy = 	"<div id = 'privacy'><p class = 'small'>Personal Information Collection and Usage <br /><br />If you have have signed up for beta testing, then some personal information is stored in the form of your email address and any information you disclose to us via email.  Dolarya will not sell this information, and will only use it to communicate with testers and improve the the quality of the website.  Comments made by beta testers via email may be retained for further review, but all identifying information will be removed.  If you have not signed up for the beta, then no personal information is requested.<br /><br />Protection of Personal Information<br /><br />All passwords are encrypted and stored in a database.  No plain text passwords are or ever will be stored as this would pose a significant security concern to our users.<br /><br />Non-Personal Information Collection and Usage<br /><br />Cardibo uses sensors to track machine occupancy.  This means the only information garnered by the system pertains to frequency and duration of usage.  It is impossible to identify a person based solely on the information stored by Cardibo.  This information can be used for any purpose, for example using frequency of usage data to support purchasing of extra equipment or determining if restrictions must be set on workout times based on the average duration of usage<br /><br />Cookies<br /><br />Cookies are set from time to time to enhance the user experience.  In particular, cookies are set as they pertain to the gym selected by the user.  Other cookies may be stored in the future to facilitate improvements to the site, and any such changes will be accompanied by a subsequent addendum to this Privacy Policy. <br /><br />Disclosure to Third Parties<br /><br /> As mentioned above under Personal and Non-Personal Information Collection and Usage, Dolarya will only disclose Non-Personal information to third parties.  This information can be analyzed for exercise information that gyms and related companies can use to help better understand their customers.  In the event of a sale or merger, some or all Non-Personal information may be transferred to the involved parties.<br /><br />Privacy Questions<br /><br /> For any comments or concerns pertaining to Dolarya&#39's Privacy Policy, please email contact@cardibo.com.  Note that Dolarya may update its Privacy Policy at any time. Users will be alerted to any significant changes by a notification on the Cardibo website.<br /><br />Cardibo, Inc.<br />92 Pearson Rd<br />Somerville, MA 02144
	<br />Last Updated: 9/12/11<br /><br /></p></div>";

		$(".footeritem").mouseover(function(){  
     		   $(this).animate({opacity: 0.3},{queue:false, duration:200})  
		});  
		$(".footeritem").mouseout(function(){  
     		   $(this).animate({opacity: 1.0},{queue:false, duration:200})  
		});
		$(".footeritem#privacypolicy").click(function(){
		
			$.modal(privacy);
			
		});
		$("#privacyclose").click(function(){
		
			$("#privacy").fadeOut('slow');
			$("#main").animate({opacity:1.0},{queue:false, duration:200});  	
		
		});
		
		


});