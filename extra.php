<?php

$myuser;

//History bricks table
$history_bricks  = DB::connection('mysql2')->table('roof_history_bricks')->where('user_id', $user->user_id )->get();

if(!empty($history_bricks)){
    foreach($history_bricks as $history_brick){
        $history_request = [
            'user_id'           => $myuser->id,
            'brick_price'       => $history_brick->brick_price,
            'quantity'          => $history_brick->quantity,
            'remaining'         => $history_brick->remaining,
            'created_at'        => date("Y-m-d H:i:s", $history_brick->create_time),
            'type'              => $history_brick->type,
            'status'            => $history_brick->status,
            'refund_price'      => $history_brick->refund_price,
            'payment_params'    => $history_brick->payment_params,
            'refund_params'     => $history_brick->refund_params,
        ];
        $pck = DB::connection('mysql2')->table('roof_package')->where('id', $history_brick->package)->first();
        
        if(!empty($pck)){
            $mypck = Package::where('name', $pck->name)->first();
            $history_request['package'] = $mypck->id;
        }

        HistoryBrick::updateOrCreate($history_request, $history_request);
        
    }
}

//user profile table
$user_profile  = DB::connection('mysql2')->table('roof_profile')->where('user_id', $user->user_id )->first();

if(!empty($user_profiles)){
    $user_profile_request = [
        'user_id'           => $myuser->id,
        'firstname'         => $user_profile->billing_firstname	,
        'lastname'          => $user_profile->billing_lastname,
        'cardtype'          => $user_profile->billing_cardtype,
        'cardnumber'        => $user_profile->billing_cardnumber,
        'cardmonth'         => $user_profile->billing_cardmonth,
        'cardyear'          => $user_profile->billing_cardyear,
        'code'              => $user_profile->billing_code,
        'email'             => $user_profile->billing_email,
        'phone1'            => $user_profile->billing_phone1,
        'phone2'            => $user_profile->billing_phone2,
        'company'           => $user_profile->billing_company,
        'street'            => $user_profile->billing_street,
        'district'          => $user_profile->billing_district,
        'city'              => $user_profile->billing_city,
        'state'             => $user_profile->billing_state,
        'zipcode'           => $user_profile->billing_zipcode,
        'promotion_code'    => $user_profile->promotion_code,
        'customer_notes'    => $user_profile->customer_notes,
        'extended_price'    => $user_profile->extended_price,
        'standard_price'    => $user_profile->standard_price,
        'claims_price'      => $user_profile->claims_price
    ];
}

$myorder;

$promocodes = DB::connection('mysql2')->table('roof_promo_code')->where('user_id', $user->user_id)->get();

if(!empty($promocodes)){
    foreach($promocodes as $promocode){
        $promo_request = [
            'promocode_type' => $promocode->promocode_type,
            'code' => $promocode->code,
            'title' => $promocode->title,
            'description' => $promocode->description,
            'title_slug' => $promocode->title_slug,
            'prefix' => $promocode->prefix,
            'discount_type' => $promocode->discount_type,
            'discount' => $promocode->promocode_type,
            'discount_applies_on' => $promocode->discount_applies_on,
            'type_of_report' => $promocode->type_of_report,
            'min_reports_purchased' => $promocode->min_reports_purchased,
            'report_based_on' => $promocode->report_based_on,
            'min_reports_count' => $promocode->min_reports_count,
            'reports_purchased_condition' => $promocode->reports_purchased_condition,
            'start_date' => $promocode->start_date,
            'end_date' => $promocode->end_date,
            'noExpiry' => $promocode->noExpiry,
            'usage_limit_type' => $promocode->usage_limit_type,
            'usage_limit' => $promocode->usage_limit,
            'limit_per_user' => $promocode->limit_per_user,
            'limit' => $promocode->limit,
            'applies_on_brick' => $promocode->applies_on_brick,
            'status' => $promocode->status,
            // 'order_id' => 
        ];
    }
}

//Vocab child
$myvocab;

$terms = DB::connection('mysql2')->table('roof_term')->where('vocabulary_id', $vocabulary->id)->get();

if(!empty($terms)){
    foreach($terms as $term){
        $term_request = [
            'vocabulary_id' => $myvocab->id,
            // 'parent_id' =>  $term->
            'root' =>  $term->root,
            'lft' =>  $term->lft,
            'rght' =>  $term->rght,
            'level' =>  $term->level,
            'name' =>  $term->term_name,
            'description' =>  $term->term_description,
            'params' =>  $term->params,
            'total_item' =>  $term->total_item,
            'created_at' =>  date("Y-m-d H:i:s" , $term->create_time )
        ];

        Term::updateOrCreate($term_request, $term_request);
    }
}