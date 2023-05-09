<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Project;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Fluent;

class OrderController extends Controller
{
    public function index()
    {
        return Order::with('projects')->get();
    }

    public function show($id)
    {
        return Order::with('projects')->findOrFail($id);
    }

    public function store(Request $request)
    {
        $rules = [
            'status' => 'required|integer',
            'user_id' => 'required|integer',
            'customer_id' => 'required|integer',
            'shipping_address' => 'required|string',
            'shipping_state_id' => 'required|numeric',
            'shipping_zipcode' => 'required|string',
            'alternative_phone' => 'nullable|string',
            'address_on_product' => 'nullable|string',
            'subtotal' => 'required|numeric',
            'discount' => 'required|numeric',
            'taxes' => 'required|numeric',
            'observations' => 'nullable|string',
            'projects' => 'required|array',
            'projects.*.status' => 'integer',
            'projects.*.product_id' => 'required|integer',
            'projects.*.product_category_id' => 'required|integer',
            'projects.*.description' => 'nullable|string',
            'projects.*.subtotal' => 'required|numeric',
        ];

        $validator = Validator::make($request->all(), $rules);

        $validator->sometimes([
            'projects.*.type',
            'projects.*.size_xs',
            'projects.*.size_s',
            'projects.*.size_m',
            'projects.*.size_l',
            'projects.*.size_xl',
            'projects.*.size_xxl',
        ], 'required', function (Fluent $input, Fluent $item) {
            return true;
        });

        $validator->sometimes('projects.*.color', 'required|string', function ($input, $item) {
            return $item->product_category_id === 1;
        });

        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }

        $validated = $validator->validated();

        $order = Order::create([
            'status' => $validated['status'],
            'user_id' => $validated['user_id'],
            'customer_id' => $validated['customer_id'],
            'shipping_address' => $validated['shipping_address'],
            'shipping_state_id' => $validated['shipping_state_id'],
            'shipping_zipcode' => $validated['shipping_zipcode'],
            'alternative_phone' => $validated['alternative_phone'] ? $validated['alternative_phone'] : null,
            'address_on_product' => $validated['address_on_product'] ? $validated['address_on_product'] : null,
            'subtotal' => $validated['subtotal'],
            'discount' => $validated['discount'],
            'taxes' => $validated['taxes'],
            'observations' => $validated['observations'] ? $validated['observations'] : null,
        ]);

        foreach ($validated['projects'] as $projectInput) {

            $project = Project::create([
                'status' => $projectInput['status'] ? $projectInput['status'] : 1,
                'order_id' => $order->id,
                'product_id' => $projectInput['product_id'],
                'product_category_id' => $projectInput['product_category_id'],
                'description' =>   $projectInput['description'] ? $projectInput['description'] : null,
                'subtotal' => $projectInput['subtotal'],
            ]);

            if ($projectInput['product_category_id'] === 1) {
                $project->features()->create([
                    'type' => $projectInput['type'],
                    'color' => $projectInput['color'],
                    'size_xs' => $projectInput['size_xs'] ? $projectInput['size_xs'] : 0,
                    'size_s' => $projectInput['size_s'] ? $projectInput['size_s'] : 0,
                    'size_m' => $projectInput['size_m'] ? $projectInput['size_m'] : 0,
                    'size_l' => $projectInput['size_l'] ? $projectInput['size_l'] : 0,
                    'size_xl' => $projectInput['size_xl'] ? $projectInput['size_xl'] : 0,
                    'size_xxl' => $projectInput['size_xxl'] ? $projectInput['size_xxl'] : 0,
                ]);
            }
        }

        $data = [
            'code' => 201,
            'status' => 'success',
        ];

        return response()->json($data, $data['code']);
    }
}
