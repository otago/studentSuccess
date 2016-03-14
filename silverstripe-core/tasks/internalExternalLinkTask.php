<?php

/**
 * fetch list of staff members
 */
class internalExternalLinkTask extends BuildTask {

	protected $title = "updateTable";
	protected $description = "update Table task";

	/**
	 * submit Application data to EBS
	 * @param type $request
	 */
	public function run($request) {
		

		/*
		 * YES COMMENTS!
		 * 		 * 
		 * I'm getting all staff and loading them into silverstripe
		 * then
		 * i'm getting all publications and loading them in
		 * 
		 * So there are 2 calls to EBS webservices (webit) then the script just deals with the data
		 */
		
            $bigthing="286;How do I request a password for Get It Interloan Servce;;;1;90**292;This is called image element in silverstripe;Lorem ipsum dolor sit amet, consectetur adipiscing elit. Morbi eu libero a sapien interdum condimentum. Vivamus et libero condimentum, congue eros blandit, blandit diam. Vestibulum id dolor non tortor posuere dignissim.;;0;1**293;Internal link element;Lorem ipsum dolor sit amet, consectetur adipiscing elit. Morbi eu libero a sapien interdum condimentum. Vivamus et libero condimentum, congue eros blandit, blandit diam. Vestibulum id dolor non tortor posuere dignissim. Praesent elit quam, pellentesque e...;;0;1**296;Link text;Lorem ipsum dolor sit amet, consectetur adipiscing elit. Morbi eu libero a sapien interdum condimentum. Vivamus et libero condimentum, congue eros blandit, blandit diam.;;0;0**360;How do I request a password for Get It Interloan Service?;;;1;90**695;How do I request a password for Get It Interloan Service?;;;0;90**704;Which industry is for me?-image;;;0;0**2455;More information;Follow this link for more in depth information about essay question types and ways to structure your writing.;;0;57**2491;Robertson Library subject guides;;;1;230**2548;Sorry, this page has been moved. Please visit the Student Success home page.;;;0;1**190;OP Smokefree Policy;;http://www.op.ac.nz/assets/policies/MP0412.07-Smokefree-Auahi-Kore-Policy.pdf;1;0**290;here;Lorem ipsum dolor sit amet, consectetur adipiscing elit. Morbi eu libero a sapien interdum condimentum. Vivamus et libero condimentum, congue eros blandit, blandit diam. Vestibulum id dolor non tortor posuere dignissim. Praesent elit quam, pellentesque e...;https://www.google.co.nz/;0;0**351;More Google Scholar search tips;;https://scholar.google.co.nz/intl/en/scholar/help.html;0;0**405;More information about APA style guide.;APA style guide from University of Purdue;https://owl.english.purdue.edu/owl/resource/560/1/;1;0**412;Cite this for me;;http://www.citethisforme.com;1;0**414;Endnote;;http://endnote.com/;1;0**416;Microsoft Word tutorial;;http://www.time4english.com/aamain/writing/wacmainn.asp;1;0**492;Reading productivity tool:  Accelareader;;http://accelareader.com/;1;0**499;;This Youtube video provides a helpful introduction;http://www.youtube.com/watch?v=xOlJiMKEjpY;1;0**548;Here are some tips to reduce your grocery bill.;;http://www.nhs.uk/Livewell/Onabudget/Pages/Savemoneyfood.aspx;1;0**560;Student sex;Learn more about common STIs among students. Also watch the video Members of the public talk about using condoms. on this site.;http://www.nhs.uk/Livewell/studenthealth/Pages/Sexualhealth.aspx;1;0**682;http://passwordreset.op.ac.nz;;http://passwordreset.op.ac.nz;1;0**683;https://passwordregistration.op.ac.nz/default.aspx;;https://passwordregistration.op.ac.nz/default.aspx;1;0**810;A very useful podcast on procrastination avoidance made practical:;http://maclife.mcmaster.ca/academicskills/media/mp3/2004_procrastination.mp3;http://maclife.mcmaster.ca/academicskills/media/mp3/2004_procrastination.mp3;1;0**1002;Essay Map;You can use this essay mapping tool to plan your essay.;http://www.readwritethink.org/files/resources/interactives/essaymap/;1;0**1049;http://www.youtube.com/watch?v=-QVRiMkdRsU;;http://www.youtube.com/watch?v=-QVRiMkdRsU;1;0**1148;Occupation Outlook;http://www.dol.govt.nz/publications/lmr/occupational-outlook/;http://www.dol.govt.nz/publications/lmr/occupational-outlook/;1;0**1285;Application form for a Streamlined Visa Nomination Letter;;http://www.op.ac.nz/assets/PDFs/2014/FINAL-Application-form-streamlined-visa.pdf;1;0**1360;Reading productivity tool: Accelareader;;http://accelareader.com/;1;0**1543;Learn how to use PowerPoint.;;http://office.microsoft.com/en-us/powerpoint-help/create-your-first-presentation-RZ010186615.aspx;1;0**1607;Nursing Council of New Zealand;;http://www.nursingcouncil.org.nz/;1;0**1608;New Zealand Chamber of Commerce;;http://www.newzealandchambers.co.nz/;1;0**1609;Career Quest;This tool helps people discover jobs through an online questionnaire. It analyses people’s interest in different types of work, and matches these interests to more than 400 jobs.;http://www.careers.govt.nz/tools/careerquest/;1;0**1723;Analytical example of an essay for nursing students;;http://www.sagepub.com/sites/default/files/upm-binaries/45887_Example_Essays_Critical_Thinking_and_Writing_for_Nursing_Students.pdf;1;0**1753;OPSA website;;http://opsa.tempsite.co.nz/;1;0**1780;Quick Start Guide for Adobe Connect Participants.;If you want, you can also make use of this extra information from Adobe.com;https://seminars.adobeconnect.com/_a227210/vqs-participants/;1;0**1811;Editing your profile;View this video for more instructions on how to edit your profile.;http://www.lynda.com/Moodle-tutorials/Editing-your-profile/85411/89024-4.html;1;0**1822;Core Rules of Netiquette;General guidelines for expected online behaviour.;http://www.albion.com/netiquette/corerules.html;1;0**1829;Depression booklet;For more information on depression download this booklet from the National Institute of Mental Health.;http://www.nimh.nih.gov/health/publications/depression/depression-booklet_34625.pdf;1;0**1875;Subscribe to eTV;;http://www.etv.org.nz/;1;0**1906;;;http://view.op.ac.nz;1;0**1908;Horizon View Portal;;http://view.op.ac.nz;1;0**1921;http://view.op.ac.nz;;http://view.op.ac.nz;1;0**1955;Download the Mac printing software;;http://www.op.ac.nz/assets/Uploads/iss/OP-PRINTING.dmg;1;0**1973;Mind map examples;View mind maps examples for different disciplines.;http://www.mind-mapping.co.uk/mind-map-examples/;1;0**1977;Further information about essays from Otago University;;http://www.otago.ac.nz/mofy/otago042510.pdf;1;0**2260;10 tips on how to make slides that communicate your idea.;;http://blog.ted.com/10-tips-for-better-slide-decks/;1;0**2285;Download EndNote X6 for Windows;;http://www.op.ac.nz/assets/largefiles/Endnote-601.exe;1;0**2286;Download EndNote X6 for Mac;    ;http://www.op.ac.nz/assets/largefiles/EndNote-X6-Site-Installer.dmg;1;0";
            
          //  echo dateStamp();
           // $csv = array_map('str_getcsv', $bigthing);
           // 
           // 
           // 
         $big=explode('**',$bigthing);
         
          // $myarray=$this->csvToArray( $bigthing);
          // var_dump($myarray);
            //ID;LinkText;LinkDescription;LinkURL;NewWindow;InternalLinkID
           
         
         
         
    //     DB::query('UPDATE "Player" SET "Status"=\'Active\'');
         /*
          DB::query("update widget_live
set
className='ElementLink'
where classname in ('ElementInternalLink', 'ElementExternalLink')");
          DB::query("update widget
set
className='ElementLink'
where classname in ('ElementInternalLink', 'ElementExternalLink')");

          */
          
          
          
          
        $update = SQLUpdate::create('"widget"')->addWhere(array('"ClassName" = ? OR "ClassName" = ?' => array('ElementInternalLink', 'ElementExternalLink')));

        // Assigning a value using a pure SQL expression
        $update->assign('ClassName', "ElementLink");

        // Perform the update
        $update->execute();
        $update = SQLUpdate::create('"widget_live"')->addWhere(array('"ClassName" = ? OR "ClassName" = ?' => array('ElementInternalLink', 'ElementExternalLink')));

        // Assigning a value using a pure SQL expression
        $update->assign('ClassName', "ElementLink");

        // Perform the update
        $update->execute();
          
          
          
          
         // var_dump($update);
          
          
          
          
          return;
         //  return;
           foreach($big as $item)
            {
               // var_dump( $me);
               $me=explode(';',$item);
               
                $thing = elementlink::create();
                $thing->ID=$me[0];
                $thing->LinkText=$me[1];
                $thing->LinkDescription=$me[2];
                $thing->LinkURL=$me[3];
                $thing->NewWindow=$me[4];
                $thing->InternalLinkID=$me[5];

                $thing->write();
                $thing->publish('Stage', 'Live');
                if ($thing->ID==286)
                {
                    var_dump($thing);
                   // return;
                }
                
                
                
            }
            
                
                
                
                
                
		echo "Finished";
	}
        
        public function csvToArray($file) {
                $rows = array();
                $headers = array();
                if (file_exists($file) && is_readable($file)) {
                    $handle = fopen($file, 'r');
                    while (!feof($handle)) {
                        $row = fgetcsv($handle, 10240, ',', '"');
                        if (empty($headers))
                            $headers = $row;
                        else if (is_array($row)) {
                            array_splice($row, count($headers));
                            $rows[] = array_combine($headers, $row);
                        }
                    }
                    fclose($handle);
                } else {
                    throw new Exception($file . ' doesn`t exist or is not readable.');
                }
            return $rows;
        }

	public function dateStamp() {
		return '[' . date('Y-m-d H:i:s') . ']';
	}
        
        
        

}
