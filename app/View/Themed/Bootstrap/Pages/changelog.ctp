<?php
/**
 * Catalyst Changelog
 */
?>
<div class="row">
	<div class="col-md-8 col-md-offset-2">
		<div class="page-header">
			<h1><?php echo __( 'Changelog' ); ?></h1>
		</div>
	</div>
</div>

<div class="row">
	<div class="col-md-8 col-md-offset-2">
		<h3><?php echo __( '14th October 2015' ); ?></h3>
		<ul>
			<li>System warns user if their login has expired.</li>
			<li>Debt transfers now log the transfer date for historical display.</li>
			<li>Fixed Firefox issue where Progress Log Export appeared blank.</li>
		</ul>
		<h3><?php echo __( '16th September 2015' ); ?></h3>
		<ul>
			<li>Added date filtering to progress log.</li>
			<li>Made filters apply to progress log export.</li>
			<li>Capped progress log export at 1000 entries (with warning message if exceeded).</li>
		</ul>
		<h3><?php echo __( '6th July 2015' ); ?></h3>
		<ul>
			<li>Fixed problem setting longer letter reminder periods.</li>
		</ul>
		<h3><?php echo __( '17th June 2015' ); ?></h3>
		<ul>
			<li>Made performance improvements to the Progress Log.</li>
			<li>Fixed issue where uploaded PDF files could not be deleted from client files area.</li>
		</ul>
		<h3><?php echo __( '3rd June 2015' ); ?></h3>
		<ul>
			<li>Further performance improvements to adding/viewing notes &amp; reminders.</li>
			<li>Improved support requests system, with proper issue tracking (now requires an email address).</li>
			<li>Fixed a CFS issue where some "other" priority expenditure didn't calculate the offer correctly.</li>
			<li>DIARY BETA-TESTERS: Refined prompt on bulk-completion option to show centres affected.</li>
		</ul>
		<h3><?php echo __( '26th May 2015' ); ?></h3>
		<ul>
			<li>Fixed issue where letter reminders were not being shown in diary.</li>
			<li>Enabled viewing of recently-completed diaries, which can now be marked as outstanding in case completed in error.</li>
			<li>Increased client-file size limit to 10Mb.</li>
			<li>DIARY BETA-TESTERS: Added bulk-completion option ("catch me up")</li>
		</ul>
		<h3><?php echo __( '20th May 2015' ); ?></h3>
		<ul>
			<li>Added support for centre-wide notes</li>
			<li>Fixed issue where editing notes sometimes gave "internal error"</li>
		</ul>
		<h3><?php echo __( '19th May 2015' ); ?></h3>
		<ul>
			<li>DIARY BETA-TESTERS: Default display is now week view on dashboard; last selection remembered</li>
			<li>DIARY BETA-TESTERS: Client code shown on diary popups</li>
		</ul>
		<h3><?php echo __( '6th May 2015' ); ?></h3>
		<ul>
			<li>DIARY BETA-TESTERS: Dashboard available for testing</li>
		</ul>
		<h3><?php echo __( '5th May 2015' ); ?></h3>
		<ul>
			<li>Users can now change their own email address from the menu in the top right</li>
		</ul>
		<h3><?php echo __( '18th March 2015' ); ?></h3>
		<ul>
			<li>Added the debt statistics report.</li>
			<li>Certain 'Other' expenses are now able to be labelled.</li>
			<li>The CFS reflects changes to these 'Other' labels.</li>
			<li>Fixed a permissions issue with letters.</li>
			<li>Minor UI code updates.</li>
			<li>Updated the diary filter to allow users to see all reminders for clients in their centre.</li>
			<li>Transferred debts now retain their position on the debt management page.</li>
			<li>Fixed 'No Content' errors.</li>
			<li>Slightly increased the size of the CMA logo in letters.</li>
		</ul>
		<h3><?php echo __( '10th March 2015' ); ?></h3>
		<ul>
			<li>Smoothed the notification animation.</li>
			<li>Improved the labelling of notes in the diary interface.</li>
			<li>Templates now have a reminder delay (set in days).</li>
			<li>Letters can now have reminders, this requires an additional step when generating letters.</li>
			<li>Fixed an issue when creating new records in the database that would sometimes result in an error.</li>
			<li>Fixed creditor website validation.</li>
		</ul>
		<h3><?php echo __( '25th February 2015' ); ?></h3>
		<ul>
			<li>Creditors now have 'display names' which can be used to provide a more detailed description.</li>
			<li>Fixed a number of notices throughout the client section.</li>
			<li>Notifications are now sent to administrators when a support request is made.</li>
			<li>Debts are now correctly ordered on all relevant pages.</li>
			<li>Significant changes have been made to letter generation and templates that results in DOC downloads now working correctly.</li>
			<li>Tweaked all PDF export margins to improve page layout.</li>
			<li>Template previews now open in a new page.</li>
			<li>Tweaks made to a couple of themes.</li>
			<li>Improved code to reduce warnings given when using the file upload feature.</li>
			<li>Country name has been removed from a number of places.</li>
		</ul>
		<h3><?php echo __( '20th February 2015' ); ?></h3>
		<ul>
			<li>Tweaks made to a couple of themes.</li>
			<li>Debt transfer now shows the new creditor's address.</li>
			<li>Improved CFS font sizing and layout.</li>
			<li>Implemented more visible warnings about unsaved data on the incomes and expenses modals.</li>
		</ul>
		<h3><?php echo __( '16th February 2015' ); ?></h3>
		<ul>
			<li>Increased the font size on a number of PDF exports.</li>
			<li>Deleted priority debts no longer appear on the CFS.</li>
			<li>The CFS now has an overflow page in case there are more than 20 non-priority debts.</li>
		</ul>
		<h3><?php echo __( '12th February 2015' ); ?></h3>
		<ul>
			<li>Implemented letter headers and footers.</li>
			<li>Renamed 'Settings' to 'Administration'.</li>
			<li>Updated PDF generation code which may improve performance.</li>
			<li>Added a 'preview' button to the letter and template edit UI.</li>
			<li>Client index now shows created date, and allows filtering by status.</li>
			<li>Client debts can now be exported into a PDF.</li>
		</ul>
		<h3><?php echo __( '9th February 2015' ); ?></h3>
		<ul>
			<li>The diary now behaves in a more similar manner to the Centre Manager diary.</li>
			<li>Debt status functionality has been disabled.</li>
			<li>Debts are now listed by priority/non-priority, then by created date.</li>
			<li>Creditors can no longer be deleted by basic users.</li>
			<li>Improved full name display across the client section.</li>
			<li>Improved creditor filtering in the client section.</li>
			<li>Updated a couple of themes.</li>
			<li>Added budget sheet export PDF.</li>
			<li>Added a trigger figures index page.</li>
			<li>Updated the default templates to provide a consistent look.</li>
			<li>PDFs now open in a new tab.</li>
			<li>Improved the use of English in some messages.</li>
			<li>Changed the order of 'Recently Generated Letters'.</li>
			<li>Fixed the template filter in a number of locations.</li>
			<li>Made small improvements to the datepicker across the site.</li>
		</ul>
		<h3><?php echo __( '29th January 2015' ); ?></h3>
		<ul>
			<li>The CFS now opens in a new tab.</li>
			<li>Added the 'Additional Adult' option for clients.</li>
			<li>Debts are now ordered by the date they were created on.</li>
			<li>Fixed PDF character encoding issues.</li>
			<li>The current client's name is now shown on all client-related pages alongside the code.</li>
			<li>All references to 'Member' and 'User' have been changed to 'Adviser' for consistency.</li>
			<li>Added an edit link to notes when hovering over them.</li>
			<li>The debt listing page now displays each debt's reference number.</li>
			<li>People now have a new 'Middle Name(s)' field.</li>
			<li>All references to a creditor are now updated when that creditor is edited.</li>
			<li>The CFS now has a larger margin.</li>
			<li>Fixed a couple of edge cases concerning data segregation.</li>
			<li>Templates no longer change their order when being edited, they are now ordered by code.</li>
			<li>Debts are now ordered by created date on the CFS.</li>
			<li>Fixed a divide-by-zero error that would occur in rare cases with £0 pro-rata debts.</li>
			<li>Offer frequency now defaults to 'Monthly' for new debts.</li>
			<li>Fixed a client search regression.</li>
			<li>Fixed issues with PHP sessions, users should now have a better experience using the site.</li>
			<li>Login prompts should be less frequent, and the number of blackhole errors should be significantly
				reduced.
			</li>
			<li>Notes are now consistently ordered by created date and display the name of the adviser that created
				them.
			</li>
		</ul>
		<h3><?php echo __( '23rd January 2015 - (Release 2)' ); ?></h3>
		<ul>
			<li>Made a few changes to sessions to improve security.</li>
			<li>Client codes must now be unique.</li>
			<li>You will now be taken to the client you have just created in the 'New Client' form.</li>
			<li>Removed 'Delete Client' button for normal users.</li>
			<li>Titles ('Mr', 'Mrs', etc.) are now correctly displayed.</li>
			<li>Client code is now used in place of debt reference in cases where it has not been set.</li>
			<li>Moved 'Creditors' section out of settings.</li>
			<li>Removed the day from some date strings.</li>
			<li>Corrected the spelling of 'licence' in the CFS.</li>
			<li>Notes are now ordered by modified date, they also display the name of the user that modified them.</li>
			<li>Only users with supervisor permission or higher may delete a client.</li>
			<li>Number of cars now defaults to zero on the 'Add Client' form.</li>
			<li>Debts are now listed on a single page.</li>
			<li>References to 'City' have now been changed to 'Town/City'.</li>
			<li>Changed a number of button names to correctly match their actions.</li>
		</ul>
		<h3><?php echo __( '15th January 2015' ); ?></h3>
		<ul>
			<li>Completed implementation of the recently generated letters functionality.</li>
			<li>Updated the template and creditor sections to add search and implement permission levels.</li>
			<li>Added the MAT logo to the CFS.</li>
			<li>Added the ability to add new templates.</li>
			<li>Fixed issues surrounding the ability to edit existing templates.</li>
			<li>Hidden more links to restricted areas from users without specific permissions.</li>
			<li>Optimised the system database, significantly improving site performance.</li>
		</ul>
		<h3><?php echo __( '30th December 2014' ); ?></h3>
		<ul>
			<li>Implemented the interface for editing recently generated letters.</li>
			<li>Added CFS Licence number requirement.</li>
		</ul>
		<h3><?php echo __( '19th December 2014' ); ?></h3>
		<ul>
			<li>Added file cleanup code to help save space on the server.</li>
			<li>Improved a number of interface elements, focusing specifically on the diary section.</li>
			<li>Fixes for the diary, letter templates, and advisers areas.</li>
		</ul>
		<h3><?php echo __( '16th December 2014' ); ?></h3>
		<ul>
			<li>Fixed an issue where addresses would display incorrectly in rare cases.</li>
			<li>Improved system structure which has decreased page load times in some areas of the application.</li>
			<li>Updated a couple of plugins, improving the notification system.</li>
		</ul>
		<h3><?php echo __( '10th December 2014' ); ?></h3>
		<ul>
			<li>Added the ability to filter the diary down to a single client, also allows filtering by status.</li>
			<li>The diary now separates notes by date, improving readability.</li>
			<li>All users are now able to change their own theme.</li>
		</ul>
		<h3><?php echo __( '8th December 2014 - (Release 1)' ); ?></h3>
		<ul>
			<li>Updated to the latest set of letter templates from CMA.</li>
			<li>Made a number of tweaks to improve site security.</li>
			<li>Users may now choose to export letters in the doc format.</li>
		</ul>
		<h3><?php echo __( '5th December 2014' ); ?></h3>
		<ul>
			<li>Added the 'Diary' section.</li>
			<li>Transferred debts now take their notes with them.</li>
			<li>Updated the themes to fix a couple of issues with input boxes.</li>
			<li>From now, users may only create other users below their own permission level.</li>
			<li>Adviser management has been added to the client section.</li>
		</ul>
		<h3><?php echo __( '28th November 2014' ); ?></h3>
		<ul>
			<li>Fixed an issue with transferred non-priority debts where they would appear twice in the CFS.</li>
			<li>The CFS will now show the affiliate logo images in the top right corner.</li>
			<li>Fixed an issue where the CFS was failing to display the correct number of dependent children.</li>
			<li>New users are now provided with the Catalyst default theme when they are created, this can be changed
				later.
			</li>
			<li>Fixed an issue that prevented the correct pro rata values from being calculated correctly for
				non-priority debts.
			</li>
			<li>Prevented the CFS from being a bit too generous with offers on pro rata debts when the amount available
				to pay to creditors was greater than the amount owed.
			</li>
			<li>Fixed an issue where all notes were being assigned reminder dates.</li>
			<li>Administrators may now close and re-open support requests.</li>
			<li>Clients now have a status, this can be set to either 'Open' or 'Closed'.</li>
		</ul>
		<h3><?php echo __( '25th November 2014 - (Beta 4)' ); ?></h3>
		<ul>
			<li>Updated themes to fix a number of display issues.</li>
			<li>Made significant improvements to the progress log, including the ability to filter results.</li>
			<li>Improved page load times in the client section.</li>
			<li>Fixed an issue where deleted notes and notes for deleted entities still appeared in the progress log.
			</li>
			<li>Updated the link on the home page to prevent any confusion over the user's session status.</li>
			<li>Implemented the client review section which will be built upon in a future update.</li>
			<li>Improved the code used for generating letters, which also allows copies of the CFS to be saved in the
				system.
			</li>
			<li>Added finance data to the client details page.</li>
			<li>Removed the ability to delete creditors that are associated with one or more debts.</li>
			<li>Updated the main menu bar to prevent confusion.</li>
			<li>Added the ability to transfer debts to another creditor.</li>
			<li>Fixed an issue with the CFS where (in rare cases) it would fail to correctly calculate the sum of the
				priority debts.
			</li>
			<li>Users may now create a new creditor from the new debt and edit debt forms.</li>
			<li>Fixed an issue with letter generation on the debt page where the zip file would download without an
				extension in some browsers.
			</li>
			<li>Updated the help section, allowing users to close requests and administrators to manage feedback.</li>
			<li>Fixed an issue with letter generation on the debt page where the contents of the zip would not have file
				extensions.
			</li>
			<li>Set the final default theme for the site.</li>
		</ul>
		<h3><?php echo __( '31st October 2014 - (Beta 3)' ); ?></h3>
		<ul>
			<li>Added the client checklist.</li>
			<li>Notes with line breaks now display in their intended format.</li>
			<li>Added the ability to set reminders on all notes.</li>
			<li>Fixed issues with PDF downloads on some platforms.</li>
			<li>Fixed an issue where an invalid debt category could be selected on the debt edit form.</li>
			<li>Reinstated the April 2014 version of the CFS.</li>
			<li>Reinstated the April 2014 set of incomes, expenses and debt categories.</li>
			<li>Implemented search for clients, creditors and assets.</li>
			<li>Implemented a filter for client debts.</li>
			<li>Fixed an issue with expenses and incomes failing to validate.</li>
			<li>Changed 'Details' to 'Client Details' in the client section.</li>
			<li>Updated the progress log export format.</li>
			<li>Users may now export notes for specific debts via the debt view page.</li>
			<li>Fixed an issue where expense categories failed to validate.</li>
		</ul>
		<h3><?php echo __( '9th October 2014' ); ?></h3>
		<ul>
			<li>Fixed a bug that caused the trigger figure spend to be calculated incorrectly.</li>
			<li>Fixed an issue where deleted people would still be displayed in the CFS.</li>
			<li>Increased the amount that the step arrows change the field value by from &pound;0.01 to &pound;1.00 on
				the 'Manage
				Income' and 'Manage Expenditure' forms.
			</li>
		</ul>
		<h3><?php echo __( '8th October 2014 - (Beta 2)' ); ?></h3>
		<ul>
			<li>The client's name is now displayed on the client index page.</li>
			<li>The client details page has been updated to include the client name and contact details.</li>
			<li>Person 'status' has been changed to 'role', and those roles have been changed to those suggested by
				testers.
			</li>
			<li>'Submit' buttons have been changed to 'Save' across the system.</li>
			<li>Normal users no longer have the ability to delete a client, only managers have this permission.</li>
			<li>A client can no longer have a negative number of cars.</li>
			<li>Users may now export the progress log for each client as a PDF.</li>
			<li>Significantly changed the income and expense categories, as well as trigger figures which has resulted
				in an updated CFS.
			</li>
			<li>Debt status can now be updated using the edit form, a quick update mechanism will be added in a future
				patch.
			</li>
			<li>Notes can now be made for each income and expense.</li>
			<li>Debts now use account 'number' instead of 'code'.</li>
			<li>Creditor order has been fixed.</li>
		</ul>
		<h3><?php echo __( '18th September 2014' ); ?></h3>
		<ul>
			<li>Replaced fax with mobile across the system.</li>
			<li>Improved navigation within the client area.</li>
			<li>Updated the income, expense and debt categories.</li>
		</ul>
		<h3><?php echo __( '15th September 2014 - (Beta 1)' ); ?></h3>
		<ul>
			<li>Added the ability to generate letters to clients and creditors.</li>
			<li>Users are now able to select from a list of themes, providing them with the ability to choose how they
				want the system to look.
			</li>
			<li>Significantly improved the template system, though it's full functionality is not yet available to
				users.
			</li>
			<li>Improved data validation, form security and overall system speed by reducing the number of recursive SQL
				queries.
			</li>
			<li>Added the ability to update notes made in the system.</li>
			<li>Implemented full data segregation for clients.</li>
			<li>Updated the client financial statement, and improved trigger figures.</li>
		</ul>
	</div>
</div>
