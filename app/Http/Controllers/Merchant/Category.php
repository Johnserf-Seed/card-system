<?php
namespace App\Http\Controllers\Merchant; use App\Library\Helper; use App\Library\Response; use App\System; use Illuminate\Http\Request; use App\Http\Controllers\Controller; class Category extends Controller { function get(Request $spceaf29) { $sp8485a5 = $spceaf29->post('current_page', 1); $sp1d597f = $spceaf29->post('per_page', 20); $sp4f4bed = $this->authQuery($spceaf29, \App\Category::class); $sp117844 = $spceaf29->post('search', false); $sp73df55 = $spceaf29->post('val', false); if ($sp117844 && $sp73df55) { if ($sp117844 == 'simple') { return Response::success($sp4f4bed->get(array('id', 'name'))); } elseif ($sp117844 == 'id') { $sp4f4bed->where('id', $sp73df55); } else { $sp4f4bed->where($sp117844, 'like', '%' . $sp73df55 . '%'); } } $spb9f61b = $spceaf29->post('enabled'); if (strlen($spb9f61b)) { $sp4f4bed->whereIn('enabled', explode(',', $spb9f61b)); } $sp1447fb = $sp4f4bed->withCount('products')->orderBy('sort')->paginate($sp1d597f, array('*'), 'page', $sp8485a5); foreach ($sp1447fb->items() as $spb34970) { $spb34970->setAppends(array('url')); } return Response::success($sp1447fb); } function sort(Request $spceaf29) { $sp7a2170 = (int) $spceaf29->post('id', -1); if (!$sp7a2170) { return Response::forbidden(); } $spb34970 = $this->authQuery($spceaf29, \App\Category::class)->findOrFail($sp7a2170); $spb34970->sort = (int) $spceaf29->post('sort', 1000); $spb34970->save(); return Response::success(); } function edit(Request $spceaf29) { $sp7a2170 = (int) $spceaf29->post('id'); $sp3d006c = $spceaf29->post('name'); $spb9f61b = (int) $spceaf29->post('enabled'); $spac9944 = $spceaf29->post('sort'); $spac9944 = $spac9944 === NULL ? 1000 : (int) $spac9944; if (System::_getInt('filter_words_open') === 1) { $sp70a70d = explode('|', System::_get('filter_words')); if (($sp27b5c4 = Helper::filterWords($sp3d006c, $sp70a70d)) !== false) { return Response::fail('提交失败! 分类名称包含敏感词: ' . $sp27b5c4); } } if ($spac9944 < 0 || $spac9944 > 1000000) { return Response::fail('排序需要在0-1000000之间'); } $sp22d3ef = $spceaf29->post('password'); $sp48ad75 = $spceaf29->post('password_open') === 'true'; $spb34970 = $this->authQuery($spceaf29, \App\Category::class)->find($sp7a2170); if (!$spb34970) { $spb34970 = new \App\Category(); $spb34970->user_id = $this->getUserIdOrFail($spceaf29); } $spb34970->name = $sp3d006c; $spb34970->sort = $spac9944; $spb34970->password = $sp22d3ef; $spb34970->password_open = $sp48ad75; $spb34970->enabled = $spb9f61b; $spb34970->saveOrFail(); return Response::success(); } function enable(Request $spceaf29) { $sp7824ec = $spceaf29->post('ids', ''); if (strlen($sp7824ec) < 1) { return Response::forbidden(); } $spb9f61b = (int) $spceaf29->post('enabled'); $this->authQuery($spceaf29, \App\Category::class)->whereIn('id', explode(',', $sp7824ec))->update(array('enabled' => $spb9f61b)); return Response::success(); } function delete(Request $spceaf29) { $sp7824ec = $spceaf29->post('ids', ''); if (strlen($sp7824ec) < 1) { return Response::forbidden(); } $this->authQuery($spceaf29, \App\Category::class)->whereIn('id', explode(',', $sp7824ec))->delete(); return Response::success(); } }