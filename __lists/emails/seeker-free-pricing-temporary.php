<?php
ob_start();
include('email-header.php');
?>

<p><?php echo $_POST['fname']; ?>,</p>

<p>To answer any potential questions about the fees associated with EyeRecruit.com, there are no charges to you
or the potential employer for my services (or my personal introductions). I have been very fortunate in my
career &amp; while there are things that the company does charge for (IE: Resume Services, interview prep, and
consulting services, etc.), my main duties are quite different. While I consult as well, mostly I communicate,
evaluate, support, listen, refer, introduce and offer opinions when it is deemed helpful. I feel it is something that
can not ever be commoditized or replicated.</p>
<p>I designed EyeRecruit not as a "Recruiting" company, but as a way for quality professionals within our industry
to interact, and more importantly, to be introduced. We use the term "Recruiter" because that is the name
people recognize, but in reality our relationship is more than a recruiter, because we work on getting in-depth,
beyond the transactional level &amp; working on establishing long-term relationships based on mutual trust and
understanding throughout a career.</p>
<p>We have a lot of cool things going on right now and something really, really exciting we are rolling out over the
next two fiscal quarters. To the extent I can, I open my schedule to people currently employed within the
industry, graduates looking to get their foot in the door within our industry, members of Law Enforcement
looking to move into the private sector, and to the men &amp; women of the American Armed Forces who are
making the transition into civilian corporate life. We feel all of these areas were underserved when we stated
in 2013 and we were in a unique position to serve them with honor &amp; integrity.</p>

<p>In regards to scheduling a time to speak, I am asked all the time how I can do this for free, or what's my
"angle." It's simple, I do this out of not only my respect to the people that have given so much to us, but for the
men and women who current represent the industry that we serve. I grew up in this industry. I do it to help me
understand what we need, as individuals, as an industry, as professionals and as companies… so we all can
thrive and not just survive, in the world we currently work &amp; live.</p>
<p>There is no greater compliment than an endorsement, a positive mention, a share or a referral! I look forward
to speaking with you soon.</p>

<p>Sincerely,<br>
Christopher Bauer<br>
EyeRecruit, Inc.


<?php 
include('email-footer.php');
$message2 = ob_get_clean();
?>