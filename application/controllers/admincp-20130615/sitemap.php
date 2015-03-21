<?php
class Sitemap extends CI_Controller
{
	function __construct()
	{
		parent::__construct();
		
		$login = $this->session->userdata('username');
		
		$this->load->model('admincp/dbsitemap');
		$this->load->model('admincp/dbadminheader');
		
		if($login=='')
		{
			redirect(base_url().'admincp/login');
		}
		
        $this->load->library('google_sitemap'); //Load Plugin
	}

	function index()
	{
		$data['title']="Sitemap";
		$this->load->view('admincp/sitemap/view',$data);
	}

    function generate()
    {
		$total_links = 1;
        $sitemap = new google_sitemap; //Create a new Sitemap Object
        //$item = new google_sitemap_item(base_url()."MY_WEBSITE_URL",date("Y-m-d"), 'weekly', '0.8' ); //Create a new Item
		$item = new google_sitemap_item(base_url(), '2012-05-18', 'weekly', '0.9');
        $sitemap->add_item($item); //Append the item to the sitemap object
		$total_links++;
		
		$item = new google_sitemap_item(base_url()."create", '2012-05-18', 'weekly', '0.9');
        $sitemap->add_item($item); //Append the item to the sitemap object
		$total_links++;
		
		$tot_pics = $this->dbsitemap->gettotalpics();
		foreach($tot_pics as $row_pics)
		{
			$item = new google_sitemap_item(base_url()."view/".$row_pics->covers_id."/".friendlyURL($row_pics->covers_name).".html", $row_pics->create, 'weekly', '0.7');
			$sitemap->add_item($item); //Append the item to the sitemap object
			$total_links++;
		}
		
		for($i=0;$i<=(count($tot_pics));$i+=10)
		{
			$item = new google_sitemap_item(base_url()."page/".$i, '2012-05-18', 'daily', '0.8');
			$sitemap->add_item($item); //Append the item to the sitemap object
			$total_links++;
		}
		
		$tot_cat = $this->dbsitemap->gettotalcategory();
		foreach($tot_cat as $row_cat)
		{
			$item = new google_sitemap_item(base_url()."category/".$row_cat->covers_cat_seo, '2012-05-18', 'daily', '0.7');
			$sitemap->add_item($item); //Append the item to the sitemap object
			$total_links++;
		}
		
		$tot_pages = $this->dbsitemap->gettotalpages();
		foreach($tot_pages as $row_pages)
		{
			$item = new google_sitemap_item(base_url()."info/".$row_pages->page_seo.".html", '2012-05-18', 'daily', '0.7');
			$sitemap->add_item($item); //Append the item to the sitemap object
			$total_links++;
		}
		
		$item = new google_sitemap_item(base_url()."contacts.html", '2012-05-18', 'weekly', '0.7');
        $sitemap->add_item($item); //Append the item to the sitemap object
		$total_links++;
		
		$item = new google_sitemap_item(base_url()."create/upload.html", '2012-05-18', 'weekly', '0.9');
        $sitemap->add_item($item); //Append the item to the sitemap object
		$total_links++;
		
		$item = new google_sitemap_item(base_url()."create/collage_cover.html", '2012-05-18', 'weekly', '0.9');
        $sitemap->add_item($item); //Append the item to the sitemap object
		$total_links++;
		
		foreach($tot_cat as $row_cat)
		{
			$tot_pics_cat = $this->dbsitemap->gettotalpicsfromcategory($row_cat->covers_cat_id);
			for($i=0;$i<=($tot_pics_cat);$i+=10)
			{
				$item = new google_sitemap_item(base_url()."category/".$row_cat->covers_cat_seo."/page/".$i, '2012-05-18', 'weekly', '0.8');
				$sitemap->add_item($item); //Append the item to the sitemap object
				$total_links++;
			}
		}
		
		$tot_temp = $this->dbsitemap->gettotaltemp();
		for($i=0;$i<=(count($tot_temp));$i+=10)
		{
			$item = new google_sitemap_item(base_url()."create/collage_cover/page/".$i, '2012-05-18', 'weekly', '0.8');
			$sitemap->add_item($item); //Append the item to the sitemap object
			$total_links++;
		}

        $sitemap->build("./sitemap.xml"); //Build it...
                
        //Let's compress it to gz
        $data = implode("", file("./sitemap.xml"));
        $gzdata = gzencode($data, 9);
        $fp = fopen("./sitemap.xml.gz", "w");
        fwrite($fp, $gzdata);
        fclose($fp);
		$this->session->set_flashdata('message_type', 'success');
		$this->session->set_flashdata('status_', 'Sitemap successfully generated. Total Link :'.$total_links);
		redirect(base_url().'admincp/sitemap');
    }

    function _pingGoogleSitemaps( $url_xml )
    {
	        //Let's Ping google
        //$this->_pingGoogleSitemaps(base_url()."/sitemap.xml.gz");
       $status = 0;
       $google = 'www.google.com';
       if( $fp=@fsockopen($google, 80) )
       {
          $req =  'GET /webmasters/sitemaps/ping?sitemap=' .
                  urlencode( $url_xml ) . " HTTP/1.1\r\n" .
                  "Host: $google\r\n" .
                  "User-Agent: Mozilla/5.0 (compatible; " .
                  PHP_OS . ") PHP/" . PHP_VERSION . "\r\n" .
                  "Connection: Close\r\n\r\n";
          fwrite( $fp, $req );
          while( !feof($fp) )
          {
             if( @preg_match('~^HTTP/\d\.\d (\d+)~i', fgets($fp, 128), $m) )
             {
                $status = intval( $m[1] );
                break;
             }
          }
          fclose( $fp );
       }
       return( $status );
    }

} 