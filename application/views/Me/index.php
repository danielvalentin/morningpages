<div class="container" id="mecont">
	<section class="me">
		<h2>me/<?php echo $user->username; ?></h2>
		<div class="me-icon">
			<img src="<?php echo $user->gravatar(150); ?>" alt="Profile photo for <?php echo $user->username; ?>">
		</div>
		<div class="me-username">
			<p>Member since <?php echo $user->created(); ?></p>
			<?php if(user::logged() && user::get()->id==$user->id): ?>
<?php
				$pages = user::get()
					->pages
					->where('type','=','page')
					->order_by('created', 'DESC')
					->find_all();
?>
				<select data-bind="goToPreviousPage:true" id="pastposts">
		        	<option value="0">Previous pages (<?php echo $pages->count(); ?>)</option>
		        	<option value="/">Today</option>
<?php
					$years = array();
					if((bool)$pages->count())
					{
						foreach($pages as $p)
						{
							$stamp = $p->created;
							$year = date('Y', $stamp);
							if(!array_key_exists($year, $years))
							{
								$years[$year] = array();
							}
							$month = date('F',$stamp);
							if(!array_key_exists($month, $years[$year]))
							{
								$years[$year][$month] = array();
							}
							$years[$year][$month][] = $p;
						}
					}
					foreach($years as $year => $month)
					{
						foreach($month as $monthname => $days)
						{
							echo '<optgroup label="'.$monthname.', '.$year.'">';
							foreach($days as $day)
							{
							    $dayname = date('l ',$day->created).' the '.date('jS',$day->created);
	                            if($day->day != site::day_slug())
	                            {
	                                //$dayname = 'Today';
	                                echo '<option value="'.$day->day.'"'.($dayname==$day->day?' selected="selected"':'').'>'.$dayname.'</option>';
	                            }
								
							}
							echo '<optgroup>';
						}
					}
?>
       			</select>
       		<?php endif; ?>
			
<?php
			if(!empty($user->bio))
			{
				echo '<h3>User bio</h3>';
				echo '<p>'.$user->bio.'</p>';
			}
			if(!empty($user->website))
			{
				echo '<h3>User website</h3>';
				echo '<p><a href="'.$user->website.'" rel="nofollow">'.$user->website.'</a></p>';
			}
?>
			<h3>Points</h3>
			<p>
				<?php echo $user->points(); ?>
			</p>
		</div>

		<div class="me-stats">
			<div class="stats-header">
				<h3>User stats</h3>
			</div>
			<dl>
				<div class="stat-block">
					<dt>Longest Streak</dt>
					<dd>
						<span class="stat-circle one"><?php echo number_format($user->longest_streak); ?></span>
					</dd>
				</div>
				<div class="stat-block">
					<dt>Current Streak</dt>
					<dd>
						<span class="stat-circle two"><?php echo number_format($user->current_streak); ?></span>
					</dd>
				</div>
				<div class="stat-block">
					<dt>Longest Single Page</dt>
					<dd>
						<span class="stat-circle three"><?php echo number_format($user->most_words); ?></span>
					</dd>
				</div>
				<div class="stat-block">
					<dt>Cumulative Words</dt>
					<dd>
						<span class="stat-circle four"><?php echo number_format($user->all_time_words); ?></span>
					</dd>
				</div>
			</dl>
		</div>
		<div class="me-badges">
			<div class="badge-header">
				<h3>User badges</h3>
			</div>
			<div class="badge-container">
<?php
		
				$userachievements = $user->userachievements->find_all();
				if((bool)$userachievements->count())
				{
					foreach($userachievements as $userachievement)
					{
						echo '<div class="badge">';
						echo HTML::image('/media/img/badges/'.$userachievement->achievement->badge, array(
							'title' => $userachievement->achievement->description,
							'alt' => $userachievement->achievement->description
						));
						echo '<div class="achievement-date">'.date('m-d-Y',$userachievement->created).'</div>';
						echo '</div>';
					}
				}
?>
			</div>
		</div>

	</section>
</div>
