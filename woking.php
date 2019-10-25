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
                        "col"   => [ 'user_id','meta_key', 'meta_value']
                    ],
                    "dest"  => [
                        "table_name"    => 'user_metas',
                        "col"   => [ 'user_id','meta_key', 'meta_value']
                    ],
                    "fkey" => [
                        "user_id" => ['users', 'user_id']
                    ]
                ],
                //nodes table
                [
                    "source" => [
                        "table_name" => 'roof_node',
                        "col"   => ['user_id', 'node_alias', 'node_title', 'node_content', 'meta_title', 'meta_keywords','meta_description','node_parent', 'node_order', 'node_type', 'node_status', 'create_time']
                    ],
                    "dest"  => [
                        "table_name"    => 'nodes',
                        "col"   => ['user_id','alias', 'title', 'content', 'meta_title', 'meta_keywords','meta_description','parent', 'order', 'type', 'status', 'created_at']
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
                        "col"   => ['id','name', 'price', 'brick_price', 'quantity', 'image', 'measurement_summary', 'roof_photo', 'logo_customization', 'length_measutements', 'pitch_measurements', 'area_measurements', 'waste_calculation_tables', 'notes_oage', 'editable_format', 'estimation_software_compatibility', 'delivery', 'report_length', 'common_users']
                    ],
                    "dest"  => [
                        "table_name"    => 'packages',
                        "col"   => ['stfk','name', 'price', 'brick_price', 'quantity', 'image', 'measurement_summary', 'roof_photo', 'logo_customization', 'length_measutements', 'pitch_measurements', 'area_measurements', 'waste_calculation_tables', 'notes_oage', 'editable_format', 'estimation_software_compatibility', 'delivery', 'report_length', 'common_users']
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
                        "col"   => [ 'quantity', 'user_id', 'package_id', 'package_name', 'package_price', 'delivery', 'delivery_price', 'package_report_length', 'comment', 'notes', 'to_team_note', 'additional_emails', 'message', 'report_logo', 'report_file', 'send_report_to','discount','payment_gateway','payment_status','status','refund_price','create_time','type','payment_params','refund_params','total_price']
                    ],
                    "dest"  => [
                        "table_name"    => 'orders',
                        "col"   => ['quantity', 'user_id', 'package_id', 'name', 'price', 'delivery', 'delivery_price', 'report_length', 'comment', 'notes', 'to_team_note', 'additional_emails', 'message', 'report_logo', 'report_file', 'send_report_to','discount','payment_gateway','payment_status','status','refund_price','created_at','type','payment_params','refund_params','total_price']
                    ],
                        "fkey" => [
                            "user_id" => ['users', 'user_id'],
                            "package_id" => ['packages', 'package_id']
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
                //status_orders table
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
                // [
                //     "source" => [
                //         "table_name" => 'roof_assign_report',
                //         "col"   => ['order_id', 'user_id', 'create_time', 'status' ,'document_file', 'report_file']
                //     ],
                //     "dest"  => [
                //         "table_name"    => 'assign_reports',
                //         "col"   => ['order_id', 'user_id', 'created_at', 'status' ,'document_file', 'report_file']
                //     ]
                // ],

                //resources table
                [
                    "source" => [
                        "table_name" => 'roof_resource',
                        "col"   => ['user_id', 'resource_name', 'resource_description','resource_path','resource_type','where','create_time']
                    ],
                    "dest"  => [
                        "table_name"    => 'resources',
                        "col"   => ['user_id', 'name', 'description','path','type','where','created_at']
                    ],
                    "fkey" =>  [
                        "user_id" => ['users', 'user_id']
                    ]
                ],

                //settings table
                [
                    "source" => [
                        "table_name" => 'roof_settings',
                        "col"   => ['category', 'key','value']
                    ],
                    "dest"  => [
                        "table_name"    => 'settings',
                        "col"   => ['category', 'key','value']
                    ]
                ],
                //term_relationships table
                // [
                //     "source" => [
                //         "table_name" => 'roof_term_relationship',
                //         "col"   => ['node_id', 'term_id']
                //     ],
                //     "dest"  => [
                //         "table_name"    => 'term_relationships',
                //         "col"   => ['node_id', 'term_id']
                //     ]
                // ],

                //terms table
                [
                    "source" => [
                        "table_name" => 'roof_term',
                        "col"   => ['vocabulary_id', 'parent_id', 'root', 'lft', 'rght', 'level', 'term_name', 'term_description', 'params',' total_item', 'create_time']
                    ],
                    "dest"  => [
                        "table_name"    => 'terms',
                        "col"   => ['vocabulary_id', 'parent_id', 'root', 'lft', 'rght', 'level', 'name', 'description', 'params',' total_item', 'created_at']
                    ]
                ],

                //report_types table
                [
                    "source" => [
                        "table_name" => 'roof_report_types',
                        "col"   => ['type', 'price']
                    ],
                    "dest"  => [
                        "table_name"    => 'report_types',
                        "col"   => ['node_id', 'term_id']
                    ]
                ],
                //comments table
                [
                    "source" => [
                        "table_name" => 'roof_comment',
                        "col"   => ['node_id', 'user_id', 'comment_username', 'comment_useremail', 'comment_userwebsite', 'comment_ip', 'comment_parent','comment_title','comment_content','comment_type','comment_status','lft','rght','level','create_time']
                    ],
                    "dest"  => [
                        "table_name"    => 'comments',
                        "col"   => ['node_id', 'user_id', 'username', 'useremail', 'userwebsite', 'ip', 'parent','title','content','type','status','lft','rght','level','created_at']
                    ]
                ],
                //contact_us table
                [
                    "source" => [
                        "table_name" => 'roof_contact_us',
                        "col"   => ['receiver_id', 'name','email','phone','subject','body','create_time','readed']
                    ],
                    "dest"  => [
                        "table_name"    => 'contact_us',
                        "col"   => ['receiver_id', 'name','email','phone','subject','body','created_at','readed']
                    ]
                ],

                //gallery_photos table
                [
                    "source" => [
                        "table_name" => 'roof_gallery_photo',
                        "col"   => ['gallery_id', 'rank','name','description','alt','file_name']
                    ],
                    "dest"  => [
                        "table_name"    => 'gallery_photos',
                        "col"   => ['gallery_id', 'rank','name','description','alt','file_name']
                    ]
                ],
                //history_bricks table
                [
                    "source" => [
                        "table_name" => 'roof_history_bricks',
                        "col"   => ['user_id', 'package','brick_price','quantity','remaining','create_time','type','status','refund_price','payment_params','refund_params']
                    ],
                    "dest"  => [
                        "table_name"    => 'history_bricks',
                        "col"   => ['user_id', 'package','brick_price','quantity','remaining','created_at','type','status','refund_price','payment_params','refund_params']
                    ]
                ],
                //node_metas table
                [
                    "source" => [
                        "table_name" => 'roof_nodemeta',
                        "col"   => ['node_id', 'meta_key','meta_value']
                    ],
                    "dest"  => [
                        "table_name"    => 'node_metas',
                        "col"   => ['node_id', 'meta_key','meta_value']
                    ]
                ],
                //node_resources table
                [
                    "source" => [
                        "table_name" => 'roof_node_resource',
                        "col"   => ['node_id', 'resource_id','group']
                    ],
                    "dest"  => [
                        "table_name"    => 'node_resources',
                        "col"   => ['node_id', 'resource_id','group']
                    ]
                ],
                //promocodes table
                [
                    "source" => [
                        "table_name" => 'roof_promo_code',
                        "col"   => ['promocode_type', 'code','title','description','title_slug','prefix','discount_type','discount','discount_applies_on','type_of_report','min_reports_purchased','report_based_on','min_reports_count','reports_purchased_condition','start_date','end_date','noExpiry','usage_limit_type','usage_limit','limit_per_user','limit','applies_on_brick','status','order_id']
                    ],
                    "dest"  => [
                        "table_name"    => 'promocodes',
                        "col"   => ['promocode_type', 'code','title','description','title_slug','prefix','discount_type','discount','discount_applies_on','type_of_report','min_reports_purchased','report_based_on','min_reports_count','reports_purchased_condition','start_date','end_date','noExpiry','usage_limit_type','usage_limit','limit_per_user','limit','applies_on_brick','status','order_id']
                    ]
                ],
                //reports table
                [
                    "source" => [
                        "table_name" => 'roof_report',
                        "col"   => ['name', 'sender_id','receiver_id','subject','body','create_time','readed']
                    ],
                    "dest"  => [
                        "table_name"    => 'reports',
                        "col"   => ['name', 'sender_id','receiver_id','subject','body','created_at','readed']
                    ]
                ],
            ];
            
            foreach($array as $key=>$conv){
                $insert_array= [];
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
                            }elseif($conv['dest']['col'][$k1] == 'value'){
                                $un = unserialize($_data->$v1);
                                $da = json_encode($un);
                                $insert[$conv['dest']['col'][$k1]] =$da;
                            }
                            else{
                                $insert[$conv['dest']['col'][$k1]] =$_data->$v1;
                            }
                             
                            //insert for forign key
                            if(!empty($conv['fkey'])){
                                foreach($conv['fkey'] as $fk=>$ta){
                                    $property = $ta[1];
                                    $obj = DB::table($ta[0])->where('stfk', $_data->$property)->select('id')->first();
                                    if(!empty($obj)){
                                        $insert[$fk] = $obj->id;
                                    }else{
                                        $insert[$fk] = null;
                                    }
                                }
                            }
                            
                        }
                        $insert_array[] = $insert;    
                       
                               // DB::table($conv['dest']['table_name'])->insert($insert);    
                    }
                    
                    $arc = array_chunk($insert_array,500);
                    foreach($arc as  $ar){
                        DB::table($conv['dest']['table_name'])->insert($ar);echo '.';
                    }
                    echo $conv['dest']['table_name']."completed \n";
                }else{
                    echo "column not match for ".$conv['source']['table_name'];
                }
               
                
            }
            
           
            
    }
}
