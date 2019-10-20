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
                [
                    "source" => [
                        "table_name" => 'roof_user',
                        "col"        => ['user_id','user_firstname','user_lastname','user_email','user_password','user_registered']
                    ],
                    "dest"   => [
                        "table_name" => 'users',
                        "col"       => ['id','firstname','lastname','email','password','registered']
                    ]
                ],
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
                            }else{
                                $insert[$conv['dest']['col'][$k1]] =$_data->$v1;
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
