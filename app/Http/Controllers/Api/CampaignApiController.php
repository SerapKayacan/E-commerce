<?php

namespace App\Http\Controllers\Api;

use App\Models\Campaign;
use App\Models\Author;
use App\Models\Category;
use App\Models\CampaignRule;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Http\Resources\CampaignResource;
class CampaignApiController extends Controller
{

    public function index()
    {
        $campaign = Campaign::with('campaign_rules', 'campaign_rules.author')->get();
        if ($campaign) {
            return CampaignResource::collection($campaign);
        } else {
            return response()->json([
                'message' => 'No record avaible'
            ], 404);
        }
    }


    public function store(Request $request)
    {

        if ($request->input('campaign_type') == 'buy_2_pay_1') {

            $validator = Validator::make($request->all(), [

                'campaign_name' => ['string', 'required', 'max:255'],
                'author_id' => ['required', 'integer', 'exists:authors,id'],
                'category_id' => ['required', 'integer', 'exists:categories,id']
            ]);


            if ($validator->fails()) {
                return response()->json([
                    'errors' => $validator->errors()
                ], 422);
            }
            $campaign = new Campaign();
            $campaign->campaign_name = $request->input('campaign_name');
            $campaign->campaign_status = 'Active';
            $campaign->save();

            $campaign_rule = new CampaignRule();
            $campaign_rule->campaign_id = $campaign->id;
            $campaign_rule->author_id = $request->input('author_id');
            $campaign_rule->category_id = $request->input('category_id');
            $campaign_rule->campaign_type = $request->input('campaign_type');
            $campaign_rule->discount_type = 'Free';
            $campaign_rule->save();
        } elseif ($request->input('campaign_type') ==  'author_type_discount') {
            $validator = Validator::make($request->all(), [

                'campaign_name' => ['string', 'required', 'max:255'],
                'author_type' => ['nullable', 'string', 'in:Local,Foreign'],
                'discount_value' => ['required', 'numeric', 'min:0', 'max:100']
            ]);


            if ($validator->fails()) {
                return response()->json([
                    'errors' => $validator->errors()
                ], 422);
            }
            $campaign = new Campaign();
            $campaign->campaign_name = $request->input('campaign_name');
            $campaign->campaign_status = 'Active';
            $campaign->save();

            $campaign_rule = new CampaignRule();
            $campaign_rule->campaign_id = $campaign->id;
            $campaign_rule->campaign_type = $request->input('campaign_type');
            $campaign_rule->author_type = $request->input('author_type');
            $campaign_rule->discount_type = 'Percentage';
            $campaign_rule->discount_value = $request->input('discount_value');


            $campaign_rule->save();
        } elseif ($request->input('campaign_type') == 'percentage_discount') {
            $validator = Validator::make($request->all(), [

                'campaign_name' => ['string', 'required', 'max:255'],
                'min_total_price' => ['required', 'numeric'],
                'discount_value' => ['required', 'numeric', 'min:0', 'max:100']
            ]);


            if ($validator->fails()) {
                return response()->json([
                    'errors' => $validator->errors()
                ], 422);
            }
            $campaign = new Campaign();
            $campaign->campaign_name = $request->input('campaign_name');
            $campaign->campaign_status = 'Active';
            $campaign->save();

            $campaign_rule = new CampaignRule();
            $campaign_rule->campaign_id = $campaign->id;
            $campaign_rule->campaign_type = $request->input('campaign_type');
            $campaign_rule->author_type = $request->input('author_type');
            $campaign_rule->discount_type = 'Percentage';
            $campaign_rule->discount_value = $request->input('discount_value');
            $campaign_rule->min_total_price = $request->input('min_total_price');



            $campaign_rule->save();
        } else {
            return response()->json([
                'message' => 'There is no such campaign_type'
            ], 404);
        }
        return response()->json([
            'message' => 'Campaign created succesfuly',
            'data' => new CampaignResource($campaign)

        ], 200);
    }

    public function show($id)
    {
        $campaign = Campaign::with(['campaign_rules'])->find($id);

        if (!$campaign) {
            return response()->json([
                'message' => 'Campaign not found'
            ], 404);
        }

        return response()->json([
            'message' => 'Campaign retrieved successfully',
            'data' => $campaign
        ], 200);
    }
    public function destroy($id)
    {
        $campaign = Campaign::withoutTrashed()->find($id);

        if ($campaign) {

            $campaign->delete();
            return response()->json([
                'message' => 'Campaign soft deleted successfully.',
                'data' => $campaign
            ], 200);
        }

        return response()->json(['message' => 'Campaign not found.'], 404);
    }
}
