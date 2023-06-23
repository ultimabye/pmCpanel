<?php

namespace Modules\FrontendCMS\Repositories;
use Modules\FrontendCMS\Entities\Pricing;

class PricingRepository {

    protected $pricing;
    public function __construct(Pricing $pricing){
        $this->pricing = $pricing;
    }
    public function getAll()
    {
        return $this->pricing::all();
    }
    public function getAllActive()
    {
        return $this->pricing::where('status',1)->get();
    }
    public function save($data)
    {
        $seller_pricing = new Pricing();
        $data['monthly_cost'] = isset($data['monthly_cost'])?$data['monthly_cost']:0;
        $data['yearly_cost'] = isset($data['yearly_cost'])?$data['yearly_cost']:0;
        $data['is_featured'] =  isset($data['is_featured']) ? 1 : 0;
        $seller_pricing->fill($data)->save();
        return $seller_pricing;
    }
    public function update($data)
    {
        return $this->pricing::where('id',$data['id'])->update([
            'name' => $data['name'],
            'monthly_cost' => isset($data['monthly_cost'])?$data['monthly_cost']:0,
            'yearly_cost' => isset($data['yearly_cost'])?$data['yearly_cost']:0,
            'team_size' => $data['team_size'],
            'stock_limit' => $data['stock_limit'],
            'category_limit' => $data['category_limit'],
            'transaction_fee' => $data['transaction_fee'],
            'best_for' => $data['best_for'],
            'status' => $data['status'],
            'is_featured' => isset($data['is_featured']) ? 1 : 0
        ]);
    }
    public function delete($id){
        $pricing = $this->pricing->findOrFail($id);
        $pricing->delete();
        return $pricing;
    }
    public function show($id){
        $pricing = $this->pricing->findOrFail($id);
        return $pricing;
    }
    public function edit($id){
        $pricing = $this->pricing->findOrFail($id);
        return $pricing;
    }
    public function statusUpdate($data, $id){
        return $this->pricing::where('id',$id)->update([
            'status' => $data['status']
        ]);
    }
}
