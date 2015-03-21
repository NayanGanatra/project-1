<?php 
echo '<?xml version="1.0" encoding="utf-8"?>' . "\n";
?>
<rss version="2.0"
    xmlns:dc="http://purl.org/dc/elements/1.1/"
    xmlns:sy="http://purl.org/rss/1.0/modules/syndication/"
    xmlns:admin="http://webns.net/mvcb/"
    xmlns:rdf="http://www.w3.org/1999/02/22-rdf-syntax-ns#"
    xmlns:content="http://purl.org/rss/1.0/modules/content/">

    <channel>
    
    <title><?php echo $feed_name; ?></title>

    <link><?php echo $feed_url; ?></link>
    <description><?php echo $page_description; ?></description>
    <dc:language><?php echo $page_language; ?></dc:language>
    <dc:creator><?php echo $creator_email; ?></dc:creator>

    <dc:rights>Copyright <?php echo gmdate("Y", time()); ?></dc:rights>
    <admin:generatorAgent rdf:resource="http://www.scriptarena.com/" />

    <?php foreach($query as $entry): ?>
        <item>

          <title><?php echo xml_convert($entry->covers_name); ?></title>
          <link><?php echo base_url()."covers/".$entry->covers_cat_seo.'/'.$entry->covers_seo;?>.html</link>
          <guid><?php echo $entry->covers_name; ?></guid>
          
          <description><?php echo $this->lang->line('rss_cover_download').' '.$entry->covers_name.' '.$this->lang->line('rss_cover_description'); ?></description>
          
          <description><![CDATA[<a href="<?php echo base_url()."covers/".$entry->covers_cat_seo.'/'.$entry->covers_seo;?>.html"><img src="<?php echo base_url()."covers-images/thumbs/".$entry->covers_image;?>"/></a><br/><?php echo $this->lang->line('rss_cover_download').' '.$entry->covers_name.' '.$this->lang->line('rss_cover_description'); ?>]]></description>
          
      <pubDate><?php //echo date ('r', $entry->post_date);?></pubDate>
        </item>

        
    <?php endforeach; ?>
    
    </channel></rss>  