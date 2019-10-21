<?php

namespace App\Console\Commands;

use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

use function Opis\Closure\unserialize;

class CopyDatabase extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'copy:database';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Copy old database to new ';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        //Tables name in old database and names in new database
        // $tables = [
        //     'roof_admin'            =>  'admins',
        //     'roof_admin_meta'       =>  'admin_metas',
        //     'roof_admin_profile'    =>  'admin_profiles',
        //     'roof_assign_report'    =>  'assign_reports',
        //     'roof_block'            =>  'blocks',
        //     'roof_comment'          =>  'comments',
        //     'roof_contact_us'       =>  'contact_us',
        //     'roof_email_template'   =>  'email_templates',
        //     'roof_gallery_photo'    =>  'gallery_photos',
        //     'roof_gallery'          =>  'galleries',
        //     'roof_history_bricks'   =>  'history_bricks',
        //     'roof_node'             =>  'nodes',
        //     'roof_nodemeta'         =>  'node_metas',
        //     'roof_node_resource'    =>  'node_resources',
        //     'roof_order'            =>  'orders',
        //     'roof_package'          =>  'packages',
        //     'roof_profile'          =>  'profiles',
        //     'roof_promo_code'       =>  'promocodes',
        //     'roof_recoveryemail'    =>  'recovery_emails',
        //     'roof_report'           =>  'reports',
        //     'roof_report_file'      =>  'report_files',
        //     'roof_resource'         =>  'resources',
        //     'roof_settings'         =>  'settings',
        //     'roof_state'            =>  'states',
        //     'roof_status_order'     =>  'status_orders',
        //     'roof_subscriber'       =>  'subscribers',
        //     'roof_term'             =>  'terms',
        //     'roof_term_relationship'=>  'term_relationships',
        //     'roof_user'             =>  'users',
        //     'roof_usermeta'         =>  'user_metas',
        //     'roof_user_emails'      =>  'user_emails',
        //     'roof_vocabulary'       =>  'vocabularies',
        // ];

        // // foreach($tables as $old_name=>$new_name){
        //     $data = DB::connection('mysql2')->table('roof_promo_code')->get();
       
        //     foreach ($data as $_data){
        //         $array = (array) $_data;
        //         // if(array_key_exists('billing_cardyear', $array)){
        //         //     $array['billing_cardyear'] = Carbon::createFromDate($array['billing_cardyear'],1,1);
                    
        //         // }
        //         // if(array_key_exists('end_date', $array)){
        //         //     $array['end_date'] = Carbon::create('2000', '01', '01');
        //         // }
        //         DB::table('promocodes')->updateOrInsert($array, $array);
        //     }
        // // }

            // $tables =    [
            //     [
            //         'roof_user' => ['user_firstname', 'user_lastname', 'user_email', 'user_password', 'user_registered'],
            //         'user'  =>  ['firstname', 'lastname', 'email', 'password', 'registered']
            //     ]
            // ];  

            // foreach($tables as $table){
            //     dd($table);
            // }
       
            // $select = DB::connection('mysql2')->table('roof_user')
            //                                   ->select('user_firstname','user_lastname','user_email',
            //                                             'user_password','user_registered')->get();
            
            // foreach ($select as $_select){
                
            //     $array = (array) $_select;
                
            //     DB::table('users')->updateOrInsert($array, $array);
            // }

            // $users = DB::connection('mysql2')->table('roof_user')->get();

            // foreach($users as $user){
            //     $array['firstname'] = $user->user_firstname;
            //     $array['lastname']  = $user->user_lastname;
            //     $array['email']  = $user->user_email;
            //     $array['password']  = $user->user_password;
            //     $array['registered']  = $user->user_registered;

            //     DB::table('users')->updateOrInsert($array, $array);
            // }

            // [
            //     "source" => [
            //         "table_name" => 'roof_promo_code',
            //         "col"   => ['promocode_type', 'code', 'title', 'description', 'title_slug', 'prefix', 'discount_type', 'discount', 'discount_applies_on', 'type_of_report', 'min_reports_purchased', 'report_based_on', 'min_reports_count', 'reports_purchased_condition', 'start_date', 'end_date', 'noExpiry', 'usage_limit_type', 'usage_limit', 'limit_per_user','limit', 'applies_on_brick', 'status', 'expired']
            //     ],
            //     "dest"  => [
            //         "table_name"    => 'promocodes',
            //         "col"   => ['promocode_type', 'code', 'title', 'description', 'title_slug', 'prefix', 'discount_type', 'discount', 'discount_applies_on', 'type_of_report', 'min_reports_purchased', 'report_based_on', 'min_reports_count', 'reports_purchased_condition', 'start_date', 'end_date', 'noExpiry', 'usage_limit_type', 'usage_limit', 'limit_per_user','limit', 'applies_on_brick', 'status', 'expired']
            //     ]
            // ],

            $array = [
                //users table
                [
                    "source" => [
                        "table_name" => 'roof_user',
                        "col"        => ['user_id','user_firstname','user_lastname','user_email','user_password','user_registered', 'user_avatar','brick_standard', 'brick_expanded', 'brick_claims','user_salt']
                    ],
                    "dest"   => [
                        "table_name" => 'users',
                        "col"       => ['stfk','firstname','lastname','email','password','registered','avatar','brick_standard', 'brick_expanded', 'brick_claims', 'salt']
                    ],
                    "fkey" => []
                ],
                //user_emails table
                [
                    "source" => [
                        "table_name" => 'roof_user_emails',
                        "col"   => [ 'user_id','email', 'status']
                    ],
                    "dest"  => [
                        "table_name"    => 'user_emails',
                        "col"   => ['user_id','email', 'status']
                    ],
                    "fkey" => [
                        "user_id" => ['users', 'user_id']
                    ]
                ],
                //user_meta table
                [
                    "source" => [
                        "table_name" => 'roof_usermeta',
                        "col"   => [ 'user_id', 'meta_key', 'meta_value']
                    ],
                    "dest"  => [
                        "table_name"    => 'user_metas',
                        "col"   => ['user_id', 'meta_key', 'meta_value']
                    ],
                    "fkey" => [
                        "user_id" => ['users', 'user_id']
                    ]
                ],
                //nodes table
                [
                    "source" => [
                        "table_name" => 'roof_node',
                        "col"   => [ 'node_alias', 'node_title', 'node_content', 'meta_title', 'meta_keywords','meta_description', 'user_id','node_parent', 'node_order', 'node_type', 'node_status', 'create_time']
                    ],
                    "dest"  => [
                        "table_name"    => 'nodes',
                        "col"   => ['alias', 'title', 'content', 'meta_title', 'meta_keywords','meta_description', 'user_id','parent', 'order', 'type', 'status', 'created_at']
                    ],
                    "fkey" => [
                        "user_id" => ['users', 'user_id']
                    ]
                ],
                //profiles table
                [
                    "source" => [
                        "table_name" => 'roof_profile',
                        "col"   => [ 'user_id','billing_firstname', 'billing_lastname', 'billing_cardtype','billing_cardnumber','billing_cardmonth','billing_cardyear','billing_code','billing_email','billing_phone1','billing_phone2','billing_company','billing_street','billing_district','billing_city','billing_state','billing_zipcode','promotion_code','customer_notes','extended_price','standard_price','claims_price']
                    ],
                    "dest"  => [
                        "table_name"    => 'profiles',
                        "col"   => ['user_id','firstname', 'lastname', 'cardtype','cardnumber','cardmonth','cardyear','code','email','phone1','phone2','company','street','district','city','state','zipcode','promotion_code','customer_notes','extended_price','standard_price','claims_price']
                    ],
                    "fkey" => [
                        "user_id" => ['users', 'user_id']
                    ]
                ],
                
                //packages table
                [
                    "source" => [
                        "table_name" => 'roof_package',
                        "col"   => ['name', 'price', 'brick_price', 'quantity', 'image', 'measurement_summary', 'roof_photo', 'logo_customization', 'length_measutements', 'pitch_measurements', 'area_measurements', 'waste_calculation_tables', 'notes_oage', 'editable_format', 'estimation_software_compatibility', 'delivery', 'report_length', 'common_users']
                    ],
                    "dest"  => [
                        "table_name"    => 'packages',
                        "col"   => ['name', 'price', 'brick_price', 'quantity', 'image', 'measurement_summary', 'roof_photo', 'logo_customization', 'length_measutements', 'pitch_measurements', 'area_measurements', 'waste_calculation_tables', 'notes_oage', 'editable_format', 'estimation_software_compatibility', 'delivery', 'report_length', 'common_users']
                    ]
                ],
                //blocks table
                [
                    "source" => [
                        "table_name" => 'roof_block',
                        "col"   => ['region', 'type', 'order', 'title' , 'params']
                    ],
                    "dest"  => [
                        "table_name"    => 'blocks',
                        "col"   => ['region', 'type', 'order', 'title' , 'params']
                    ]
                ],
                //orders table
                [
                    "source" => [
                        "table_name" => 'roof_order',
                        "col"   => [ 'order_id','quantity', 'user_id', 'package_id', 'package_name', 'package_price', 'delivery', 'delivery_price', 'package_report_length', 'comment', 'notes', 'to_team_note', 'additional_emails', 'message', 'report_logo', 'report_file', 'send_report_to','discount','payment_gateway','payment_status','status','refund_price','create_time','type','payment_params','refund_params','total_price']
                    ],
                    "dest"  => [
                        "table_name"    => 'orders',
                        "col"   => ['id','quantity', 'user_id', 'package_id', 'name', 'price', 'delivery', 'delivery_price', 'report_length', 'comment', 'notes', 'to_team_note', 'additional_emails', 'message', 'report_logo', 'report_file', 'send_report_to','discount','payment_gateway','payment_status','status','refund_price','created_at','type','payment_params','refund_params','total_price']
                    ]
                ],
                
                //email_template table
                [
                    "source" => [
                        "table_name" => 'roof_email_template',
                        "col"   => ['name', 'subject', 'help', 'body']
                    ],
                    "dest"  => [
                        "table_name"    => 'email_templates',
                        "col"   => ['name', 'subject', 'help', 'body']
                    ]
                ],
                //galleries table
                [
                    "source" => [
                        "table_name" => 'roof_gallery',
                        "col"   => ['versions_data', 'name', 'description']
                    ],
                    "dest"  => [
                        "table_name"    => 'galleries',
                        "col"   => ['versions_data', 'name', 'description']
                    ]
                ],
                //state table
                [
                    "source" => [
                        "table_name" => 'roof_state',
                        "col"   => ['state_iso', 'country_iso', 'name', 'ordering']
                    ],
                    "dest"  => [
                        "table_name"    => 'states',
                        "col"   => ['state_iso', 'country_iso', 'name', 'ordering']
                    ]
                ],
                //stauts_orders table
                [
                    "source" => [
                        "table_name" => 'roof_status_order',
                        "col"   => ['keyword', 'key_id', 'name', 'help']
                    ],
                    "dest"  => [
                        "table_name"    => 'status_orders',
                        "col"   => ['keyword', 'key_id', 'name', 'help']
                    ]
                ],
                //subscribers table
                [
                    "source" => [
                        "table_name" => 'roof_subscriber',
                        "col"   => ['email', 'firstname', 'lastname']
                    ],
                    "dest"  => [
                        "table_name"    => 'subscribers',
                        "col"   => ['email', 'firstname', 'lastname']
                    ]
                ],
                //vocabulary table
                [
                    "source" => [
                        "table_name" => 'roof_vocabulary',
                        "col"   => ['name', 'description']
                    ],
                    "dest"  => [
                        "table_name"    => 'vocabularies',
                        "col"   => ['name', 'description']
                    ]
                ],
                
                //assign_reports table
                [
                    "source" => [
                        "table_name" => 'roof_assign_report',
                        "col"   => ['order_id', 'user_id', 'create_time', 'status' ,'document_file', 'report_file']
                    ],
                    "dest"  => [
                        "table_name"    => 'assign_reports',
                        "col"   => ['order_id', 'user_id', 'created_at', 'status' ,'document_file', 'report_file']
                    ]
                ],
            ];
            
            foreach($array as $key=>$conv){
                if(count($conv['source']['col']) == count($conv['dest']['col'])){
                    // select source->col from source->table_name//
                    $data = DB::connection('mysql2')->table($conv['source']['table_name'])->select($conv['source']['col'])->get();
                    
                    // build the insert/update to dest->table->name
                    foreach($data as $_data){
                        
                        $insert  = [];
                        foreach($conv['source']['col'] as $k1=>$v1){
                            if($conv['dest']['col'][$k1] == 'versions_data'){
                                $un = unserialize($_data->$v1);
                                $da = json_encode($un);
                                $insert[$conv['dest']['col'][$k1]] =$da;
                            }elseif($conv['source']['col'][$k1] == 'create_time'){
                                $date = date("Y-m-d H:i:s", $_data->$v1);
                                $insert[$conv['dest']['col'][$k1]] =$date;
                            }
                            else{
                                $insert[$conv['dest']['col'][$k1]] =$_data->$v1;
                            }
                             
                            //insert for forign key
                            if(!empty($conv['fkey'])){
                                $obj = DB::table('users')->where('stfk', $_data->user_id)->select('id')->first();
                                if(!empty($obj)){
                                    $insert['user_id'] = $obj->id;
                                }
                            }
                        }
                        
                           
                        // inserter to destination
                        DB::table($conv['dest']['table_name'])->updateOrInsert($insert,$insert);
                    }
                    
                }else{
                    echo "column not match for ".$conv['source']['table_name'];
                }
            }
            
    }
}
