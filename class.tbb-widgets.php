<?php

define('TBB_WIDGETS_SLUG', 'tbb_widgets');

require_once dirname(__FILE__) . '/class.tgm-plugin-activation.php';
require_once dirname(__FILE__) . '/class.tbb-recentposts-widget.php';
require_once dirname(__FILE__) . '/class.tbb-recentcomments-widget.php';
require_once dirname(__FILE__) . '/class.tbb-text-widget.php';

class TBBWidgets
{
    
    
    private function __construct()
    {
        $this->init();
    }
    
    private function init()
    {
		
        add_action('tgmpa_register', array(
            $this,
            'check'
        ));
		
		
        add_action('plugins_loaded', array(
            $this,
            'initSettings'
        ), 10);
		
        add_filter('plugin_action_links_' .TBB_WIDGETS_PLUGIN_BASENAME, array(
            $this,
            'addSettingsLink'
        ));
		


    }

	
	public function addSettingsLink($links){
		
        if (!class_exists('ReduxFramework')) {
            return $links;
        }else{
			$settings_link = '<a href="options-general.php?page=' . TBB_WIDGETS_SLUG . '">Settings</a>'; 
			array_unshift($links, $settings_link); 
			return $links; 
        }
	}
    
    public function check()
    {
        /**
         * Array of plugin arrays. Required keys are name and slug.
         * If the source is NOT from the .org repo, then source is also required.
         */
        $plugins = array(
            
            // This is an example of how to include a plugin from the WordPress Plugin Repository.
            array(
                'name' => 'Redux Framework',
                'slug' => 'redux-framework',
                'required' => true
            )
            
        );
        
        $config = array( // Message to output right before the plugins table.
            'strings' => array(
                'notice_can_install_required' => __("The Blackest Box's Widgets requires the following plugin: %1$s.", TBB_WIDGETS_SLUG)
            )
        );
        
        tgmpa($plugins, $config);
    }
    
    public function initSettings()
    {
        if (!class_exists('ReduxFramework')) {
            return;
        }
        $this->reduxFramework = new ReduxFramework($this->getSections(), $this->getArgs());
        
        $this->handleSettings();
    }
    
    
    
    private function getArgs()
    {
        return array(
            // TYPICAL -> Change these values as you need/desire
            'opt_name' => TBB_WIDGETS_SLUG, // This is where your data is stored in the database and also becomes your global variable name.
            'display_name' => __("The Blackest Box's Widgets", TBB_WIDGETS_SLUG), // Name that appears at the top of your panel
            'display_version' => TBB_WIDGETS_VERSION, // Version that appears at the top of your panel
            'menu_type' => 'submenu', //Specify if the admin menu should appear or not. Options: menu or submenu (Under appearance only)
            'allow_sub_menu' => true, // Show the sections below the admin menu item or not
            'menu_title' => __('Widgets', TBB_WIDGETS_SLUG),
            'page_title' => __("The Blackest Box's Widgets", TBB_WIDGETS_SLUG),
            'admin_bar' => false, // Show the panel pages on the admin bar
            'global_variable' => '', // Set a different name for your global variable other than the opt_name
            'dev_mode' => false, // Show the time the page took to load, etc
            'customizer' => true, // Enable basic customizer support
            
            // OPTIONAL -> Give you extra features
            'page_priority' => null, // Order where the menu appears in the admin area. If there is any conflict, something will not show. Warning.
            'page_parent' => 'options-general.php', // For a full list of options, visit: http://codex.wordpress.org/Function_Reference/add_submenu_page#Parameters
            'page_permissions' => 'manage_options', // Permissions needed to access the options panel.
            'menu_icon' => '', // Specify a custom URL to an icon
            'last_tab' => '', // Force your panel to always open to a specific tab (by id)
            'page_icon' => 'icon-themes', // Icon displayed in the admin panel next to your menu_title
            'page_slug' => TBB_WIDGETS_SLUG, // Page slug used to denote the panel
            'save_defaults' => true, // On load save the defaults to DB before user clicks save or not
            'default_show' => false, // If true, shows the default value next to each field that is not the default value.
            'default_mark' => '', // What to print by the field's title if the value shown is default. Suggested: *
            'show_import_export' => false // Shows the Import/Export panel when not used as a field.
        );
    }
	
    private function getGeneralSection()
    {
        return array(
            'icon' => 'el-icon-home-alt',
            'title' => __('General', TBB_WIDGETS_SLUG),
            'fields' => array(
                array(
                    'id'        => 'section_recent_posts_start',
                    'type'      => 'section',
                    'title'     => __('Recent Posts Widget', TBB_WIDGETS_SLUG),
                    'subtitle'  => __('', TBB_WIDGETS_SLUG),
                    'indent'    => true // Indent all options below until the next 'section' option is set.
                ),
                array(
                    'id' => 'recent_posts_active',
                    'type' => 'switch',
                    'title' => __('Widget', TBB_WIDGETS_SLUG),
                    'subtitle' => __('Enable the recent posts widget.', TBB_WIDGETS_SLUG),
                    'default' => true
				),
                array(
                    'id' => 'recent_posts_stylesheet',
                    'type' => 'switch',
                    'title' => __('Stylesheet', TBB_WIDGETS_SLUG),
					'required'  => array('recent_posts_active', '=', '1'),
                    'subtitle' => __('Enable the recent posts stylesheet.', TBB_WIDGETS_SLUG),
                    'default' => true
				),
                array(
                    'id'        => 'section_recent_posts_end',
                    'type'      => 'section',
                    'indent'    => false 
                ),
                array(
                    'id'        => 'section_recent_comments_start',
                    'type'      => 'section',
                    'title'     => __('Recent Comments Widget', TBB_WIDGETS_SLUG),
                    'subtitle'  => __('', TBB_WIDGETS_SLUG),
                    'indent'    => true // Indent all options below until the next 'section' option is set.
                ),
                array(
                    'id' => 'recent_comments_active',
                    'type' => 'switch',
                    'title' => __('Widget', TBB_WIDGETS_SLUG),
                    'subtitle' => __('Enable the recent comments widget.', TBB_WIDGETS_SLUG),
                    'default' => true
				),
                array(
                    'id' => 'recent_comments_stylesheet',
                    'type' => 'switch',
                    'title' => __('Stylesheet', TBB_WIDGETS_SLUG),
					'required'  => array('recent_comments_active', '=', '1'),
                    'subtitle' => __('Enable the recent comments stylesheet.', TBB_WIDGETS_SLUG),
                    'default' => true
				),
                array(
                    'id'        => 'section_recent_comments_end',
                    'type'      => 'section',
                    'indent'    => false 
                ),         
                array(
                    'id'        => 'section_text_start',
                    'type'      => 'section',
                    'title'     => __('Text Widget', TBB_WIDGETS_SLUG),
                    'subtitle'  => __('', TBB_WIDGETS_SLUG),
                    'indent'    => true // Indent all options below until the next 'section' option is set.
                ),
                array(
                    'id' => 'text_active',
                    'type' => 'switch',
                    'title' => __('Widget', TBB_WIDGETS_SLUG),
                    'subtitle' => __('Enable the text widget.', TBB_WIDGETS_SLUG),
                    'default' => true
				),
            )
        );
    }

    
    public function getSections()
    {
        $sections = array();
        $sections[] = $this->getGeneralSection();
        
        return $sections;
    }
    
    private function handleSettings()
    {
        
        global ${TBB_WIDGETS_SLUG};
        
        $this->settings = ${TBB_WIDGETS_SLUG};
		

		add_action( 'widgets_init', array(
            $this,
            'addWidgets'
        ) );
		
		if(is_admin()){
			add_action( 'admin_enqueue_scripts', array(
	            $this,
	            'enqueueScripts'
	        )  );
		}else{
			/*
	        add_filter('wp_head', array(
	            $this,
	            'printStyles'
	        )  );
			*/
		}

    }
	
	public function enqueueScripts($current_page_hook ){
		if( 'widgets.php' != $current_page_hook )
		        return;
		wp_enqueue_script( 'tbb-widgets-script', plugins_url('assets/js/tbb-widgets.min.js', __FILE__), array( 'jquery'), '1.0', true );
		wp_enqueue_script( 'tbb-widgets-ace', plugins_url('assets/js/ace/ace.js', __FILE__));
		wp_enqueue_style('tbb-widgets-style', plugins_url('assets/css/tbb-widgets.css', __FILE__));
	}
	
	
	public function addWidgets(){
		if($this->settings['recent_posts_active']){
			
			register_widget( 'TBBRecentPostsWidget' );
			
			if(!is_admin() && $this->settings['recent_posts_stylesheet']){
					wp_enqueue_style('tbb-recent-posts-style', plugins_url('assets/css/recent-posts.css', __FILE__));
			}
		}
		
		if($this->settings['recent_comments_active']){
			
			register_widget( 'TBBRecentCommentsWidget' );
			
			if(!is_admin() && $this->settings['recent_comments_stylesheet']){
					wp_enqueue_style('tbb-recent-comments-style', plugins_url('assets/css/recent-comments.css', __FILE__));
			}
		}
		
		if($this->settings['text_active']){
			
			register_widget( 'TBBTextWidget' );
		}

	}
		
	
	private static $instance;
	

	
	public static function getInstance(){
		if(!isset(self::$instance)){
			self::$instance = new TBBWidgets();
		}
		
		return self::$instance;
	}
}