
<!-- REPLACE THIS WITH FLEX SLIDER -->
<div id="incentive">
		<div class="container">
			<div class="flexslider carousel">
	          <ul class="slides">
	            <li>
	            	<a href="careers.html">
	  	    	    <img alt="" src="images/incentive/0005_careers_symfony.png" />
					<div class="textover right bottom">
						<h2>work with us</h2>
						<p class="long">We have open positions for Symfony, if you are interested you can check out more details by clicking here.</p>
						<p class="short">We have open positions for Symfony, click here!</p>
	  	    	    </div>
	  	    		</a>
  	    		</li>
	          	<li>
	          		<a href="projects.html">
	  	    	    <img alt="" src="images/incentive/0012_projects_jobs.png" />
					<div class="textover right bottom">
						<h3>job platforms</h3>
						<p class="long">Check out our 2 job platforms and the projects built on them.</p>
	  	    	    </div></a>
  	    		</li>
	            <li>
	  	    	    <img alt="" src="images/incentive/0003_projects_culinar.png" />
	  	    	    <div class="textover right top">
						<h3>codeigniter magazine platform</h3>
						<p class="long">Something about culinar t metus, facilisis convallis orci facilisis tristique. Phasellus vel nisi justo. Morbi commodo nibh vel orci pulvinar hendrerit. Aenean quis ante ligula. Donec erat mauris, lobortis vitae semper a, fermentum vel enim. Nulla a faucibus metus.</p>
						<p class="short">Something about culinar t metus, facilisis convallis orci facilisis tristique.</p>
	  	    	    </div>
  	    		</li>
  	    		<li>
	  	    	    <img alt="" src="images/incentive/0002_projects_cvonline.png" />
	  	    	    <div class="textover left top">
						<h3>regional job platform</h3>
						<p class="long">Something about culinar t metus, facilisis convallis orci facilisis tristique. Phasellus vel nisi justo. Morbi commodo nibh vel orci pulvinar hendrerit. Aenean quis ante ligula. Donec erat mauris, lobortis vitae semper a, fermentum vel enim. Nulla a faucibus metus.</p>
						<p class="short">Something about culinar t metus, facilisis convallis orci facilisis tristique.</p>
	  	    	    </div>
  	    		</li>
	          </ul>
	        </div>
	    </div>
	</div>
<!-- REPLACE THIS WITH FLEX SLIDER -->



	<div id="content">
		<div class="container">
			<div class="row">
				<div class="span6"> 
					<!-- REPLACE THIS WITH HOME CONTENT -->
					<?php

					if (have_posts()) {
						while (have_posts()) {
							the_post();
							cfct_content();
						}
					}					
					?>
					<!-- REPLACE THIS WITH HOME CONTENT -->

				</div>
				<div class="span6"> 
					<!-- REPLACE THIS WITH HOME SIDEBAR -->
					<?php get_sidebar('home');?>
					<!-- REPLACE THIS WITH HOME SIDEBAR -->
				</div>

			</div>
		</div>
	</div>