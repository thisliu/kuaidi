# Kuaidi - 免费快递查询扩展包

本扩展包集成「快递100」、「快递网」、「快递鸟」三家快递查询接口，并进行程度的统一化。

## 用法

1. 安装。

  ```bash
  composer require wi1dcard/kuaidi
  ```

2. 创建 `Waybill`（运单） 实例。

  ```php
  // 快递 100 支持不填快递公司名称。
  $waybill = new \Kuaidi\Waybill('运单编号', '快递公司名称（不带结尾 `物流` / `快递` / `快运` / `速递` / `速运` 等字眼）');
  ```

3. 查！

  ```php
  // 三选一
  (new \Kuaidi\Trackers\Kuaidi100)->track($waybill);
  (new \Kuaidi\Trackers\Kuaidiwang)->track($waybill);
  (new \Kuaidi\Trackers\Kuaidiniao('Business ID', 'APP Key'))->track($waybill);
  ```

4. 获得数据。

  ```php
  $waybill->getStatus(); // 获取状态
  $waybill->getTraces(); // 获取详情
  ```

5. 完整实例代码请移步 [`examples`](examples/) 目录。

## 结语

这个扩展包的初衷，是因为各家快递查询接口支持的快递公司不同，有部分接口不稳定 / 缺失小众快递公司的支持；公司产品需要稳定且支持率高，所以封装出来一套比较统一的快递查询接口，包装各家的 API，也方便以后进行扩展。

目前已经在生产环境稳定使用三个月左右，解除无关依赖后修改放出，供大家参考使用。

如果你有新的公共接口 / 原有接口出现问题，欢迎 Issue 和 PR，不胜感激。

关于命名，考虑到国内外环境差距大，此扩展包多数只在国内使用；所以干脆用本地化的词语，简单好记：`Kuaidi`。

## 声明

接口来源于网络，本扩展包仅为包装和收集，仅供学习参考；对于数据准确性、接口可用性不作保证；一切法律问题自行承担。