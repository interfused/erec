<?php
if ( ! class_exists( 'WP_List_Table' ) ) 
{
  require_once( ABSPATH . 'wp-admin/includes/class-wp-list-table.php' );
}

class Users_acitivity_log extends WP_List_Table {

  public function __construct() {
    parent::__construct( array(
      'singular' => __( 'User Activity Log', 'sp' ),
      'plural'   => __( 'Users Activity Log', 'sp' ),
      'ajax'     => false
    ) );
  }

  public static function get_acitivity_logs( $per_page = 10, $page_number = 1 ) {
    global $wpdb;
    if ( $_REQUEST['page'] == 'view_complete_activity' ) {
      $sql = "SELECT * FROM {$wpdb->prefix}user_activity_log WHERE user_id = '".$_REQUEST['recID']."' ";
      $sql .= ' ORDER BY datetime DESC';
      $sql .= " LIMIT $per_page";
      $sql .= ' OFFSET ' . ( $page_number - 1 ) * $per_page;
    }
    else{
      $sql = "SELECT * FROM {$wpdb->prefix}user_activity_log GROUP BY user_id";

      if ( ! empty( $_REQUEST['orderby'] ) ) {
        $sql .= ' ORDER BY id';
        $sql .= ! empty( $_REQUEST['order'] ) ? ' ' . esc_sql( $_REQUEST['order'] ) : ' ASC';
      }
      else{
        $sql .= ' ORDER BY id DESC';
      }
      $sql .= " LIMIT $per_page";
      $sql .= ' OFFSET ' . ( $page_number - 1 ) * $per_page;
    }
    $result = $wpdb->get_results( $sql, 'ARRAY_A' );
    return $result;
  }
  
  
  public static function delete_user_acitivity_logs( $id ) {
    global $wpdb;
    if ( $_REQUEST['page'] == 'view_complete_activity' ) {
      $itemid = 'id';
    }
    else{
      $itemid = 'user_id';
    }
    $wpdb->delete(
      "{$wpdb->prefix}user_activity_log",
      array( $itemid => $id ),
      array( '%d' )
    );
  }


  public static function log_record_count() {
    global $wpdb;
    if ( $_REQUEST['page'] == 'view_complete_activity' ) {
      $sql = "SELECT * FROM {$wpdb->prefix}user_activity_log WHERE user_id = '".$_REQUEST['recID']."' ";
    }
    else{
      $sql = "SELECT * FROM {$wpdb->prefix}user_activity_log GROUP BY user_id";
    }
    return count( $wpdb->get_results( $sql ) );
  }


  public function no_items() {
    _e( 'No Users.', 'sp' );
  }


  public function column_default( $item, $column_name ) {
    switch ( $column_name ) {
      case 'user_id':
      return $item[ $column_name ];
    }
  }

 
  function column_cb( $item ) {
    if ( $_REQUEST['page'] == 'view_complete_activity' ) {
      $itemid = $item['id'];
    }
    else{
      $itemid = $item['user_id'];
    }
    return sprintf(
      '<input type="checkbox" name="bulk-delete[]" value="%s" />', $itemid
    );
  }


  function column_recruit_name( $item ) {
    $RecruitDetail = get_userdata($item['user_id']);
    $recName = $RecruitDetail->first_name.' '.$RecruitDetail->last_name;
    return $recName;
  }

  function column_recruit_email( $item ) {
    $RecruitDetail = get_userdata($item['user_id']);
    $recEmail = $RecruitDetail->user_email;
    return $recEmail;
  }

  function column_user_acitivity_log( $item ) {
    global $wpdb;
    $sql = "SELECT * FROM {$wpdb->prefix}user_activity_log WHERE user_id = '".$item['user_id']."' ORDER BY id DESC";
    $result = $wpdb->get_row($sql);
    $RecruitDetail =  $result->datetime;
    $recTime = date('d F Y h:i:s A', $RecruitDetail );
    return $recTime;
  }

  function column_user_acitivity_time( $item ) {
    global $wpdb;
    $RecruitDetail =  $item['datetime'];
    $recTime = date('d F Y h:i:s A', $RecruitDetail );
    return $recTime;
  }

  function column_view_acitivity_log( $item ) {
    global $wpdb;
    $RecruitDetail = get_userdata($item['user_id']);
    if ( $RecruitDetail != false ) {
      $recView = '<a href="'.admin_url().'admin.php?page=view_complete_activity&recID='.$item['user_id'].'">View Complete Activity</a>';
    }
    return $recView;
  }

  function column_user_acitivity_name( $item ) {
    global $wpdb;
    return $item['meta'];
  }

  function get_columns() {
    if ( $_REQUEST['page'] == 'view_complete_activity' ) {
      $columns = array(
        'cb'      => '<input type="checkbox" />',
        'user_id'    => __( 'Recruit ID', 'sp' ),
        'user_acitivity_name' => __( 'Activity', 'sp'),
        'user_acitivity_time' => __( 'Date', 'sp'),
      );
    }
    else{
      $columns = array(
        'cb'      => '<input type="checkbox" />',
        'user_id'    => __( 'Recruit ID', 'sp' ),
        'recruit_name'   => __( 'Name', 'sp' ),
        'recruit_email'   => __( 'Email', 'sp' ),
        'user_acitivity_log' => __( 'Recent Activity', 'sp'),
        'view_acitivity_log' => __( 'View Complete Activity', 'sp')
      );
    }
    return $columns;
  }


  public function get_sortable_columns() {
    $sortable_columns = array(
      'user_id'    =>    array( 'user_id', false ),
    );
    return $sortable_columns;
  }

  
  public function get_bulk_actions() {
    $actions = array(
      'bulk-delete' => 'Delete'
    );
    return $actions;
  }


  public function prepare_items() {

    $this->_column_headers = $this->get_column_info();

    $this->process_bulk_action();

    $per_page     = $this->get_items_per_page( 'current_activity_log', 10 );
    $current_page = $this->get_pagenum();
    $total_items  = self::log_record_count();

    $this->set_pagination_args( array(
      'total_items' => $total_items,
      'per_page'    => $per_page
    ) );

    $this->items = self::get_acitivity_logs( $per_page, $current_page );
  }

  public function process_bulk_action() {

    if ( 'delete' === $this->current_action() ) {

      $nonce = esc_attr( $_REQUEST['_wpnonce'] );

      if ( ! wp_verify_nonce( $nonce, 'sp_delete_user_acitivity_logs' ) ) {
          die( 'Go get a life script kiddies' );
      }
      else {
        self::delete_user_acitivity_logs( absint( $_GET['customer'] ) );
        wp_redirect( add_query_arg() );
        exit;
      }
    }

    if ( ( isset( $_POST['action'] ) && $_POST['action'] == 'bulk-delete' )
     || ( isset( $_POST['action2'] ) && $_POST['action2'] == 'bulk-delete' )
    ) 
    {

      $delete_ids = esc_sql( $_POST['bulk-delete'] );

      foreach ( $delete_ids as $id ) {
        self::delete_user_acitivity_logs( $id );
      }

      wp_redirect(add_query_arg() );
      exit;
    }
  }

}


class SP_Plugin1 {

  static $instance;

  public $customers_obj;

  public function __construct() {
    add_filter( 'set-screen-option', array( __CLASS__, 'set_screen' ), 10, 3 );
    add_action( 'admin_menu', array( $this, 'plugin_menu' ) );
  }


  public static function set_screen( $status, $option, $value ) {
    return $value;
  }

  public function plugin_menu() {
    $hook = add_menu_page(
      'Users Activity Log',
      'Users Activity Log',
      'manage_options',
      'Users_acitivity_log',
      array( $this, 'plugin_settings_page' ),
      '',
      70
    );
    add_action( "load-$hook", array( $this, 'screen_option' ) );

    $hook = add_submenu_page(
      'Users_acitivity_log',
      'View Complete Activity',
      '',
      'manage_options',
      'view_complete_activity',
      array( $this, 'plugin_settings_view_complete_activity' )
    );

    add_action( "load-$hook", [ $this, 'screen_option' ] );
  }

  public function plugin_settings_view_complete_activity() { ?>
    <div class="wrap">
      <h2>Users Activity Log list</h2>
      <h3><a href="<?php echo admin_url().'admin.php?page=Users_acitivity_log'; ?>">Back to all users activity log</a></h3>
      <div id="poststuff">
        <div id="post-body" class="metabox-holder columns-1">
          <div id="post-body-content">
            <div class="meta-box-sortables ui-sortable">
              <form method="post">
                <?php
                $this->customers_obj->prepare_items();
                $this->customers_obj->display(); 
                ?>
              </form>
            </div>
          </div>
        </div>
        <br class="clear">
      </div>
    </div>
    <?php
  }


  public function plugin_settings_page() { ?>
    <div class="wrap">
      <h2>Users Activity Log list</h2>
      <div id="poststuff">
        <div id="post-body" class="metabox-holder columns-1">
          <div id="post-body-content">
            <div class="meta-box-sortables ui-sortable">
              <form method="post">
                <?php
                $this->customers_obj->prepare_items();
                $this->customers_obj->display(); 
                ?>
              </form>
            </div>
          </div>
        </div>
        <br class="clear">
      </div>
    </div>
    <?php
  }

  public function screen_option() {
    $option = 'per_page';
    $args   = array(
      'label'   => 'Users Activity Log',
      'default' => 10,
      'option'  => 'current_activity_log'
    );
    add_screen_option( $option, $args );
    $this->customers_obj = new Users_acitivity_log();
  }

  public static function get_instance() {
    if ( ! isset( self::$instance ) ) {
      self::$instance = new self();
    }
    return self::$instance;
  }
}


add_action( 'plugins_loaded',function() {
  SP_Plugin1::get_instance();
} );
error_reporting(0);