					<div class="eventActions-tocalendar">
						<span class="icon-calendar"> </span>
						<span class="addtocalendar atc-style-blue">
					    <var class="atc_event">
					        <var class="atc_date_start" itemprop="startDate" datetime="<?php echo strftime('%Y-%m-%dT%H:%M:00', $event_first_date ); ?>"><?php echo strftime('%Y-%m-%d %H:%M:00', $event_first_date ); ?></var>
					        <var class="atc_date_end" itemprop="endDate" datetime="<?php echo strftime('%Y-%m-%dT%H:%M:00', $event_last_date ); ?>"><?php echo strftime('%Y-%m-%d %H:%M:00', $event_last_date ); ?></var>
					        <var class="atc_timezone">Europe/Paris</var>
					        <var class="atc_title"><?php the_title(); ?></var>
					        <var class="atc_description"><?php echo $noms_principaux; ?></var>
					        <var class="atc_location">l'Avant Seine - Théâtre de Colombes - Parvis des Droits de l'Homme, 88 rue Saint Denis, 92700 Colombes</var>
					        <var class="atc_organizer">'Avant Seine</var>
					        <var class="atc_organizer_email">anne.legall@lavant-seine.com</var>
					    </var>
					  </span>
					</div>