# NewTwitterGeter
特定ユーザーの新しいツイートを取得する奴

## 必要なもの
Twitter Application Managementから取得できるコンシューマーキーなど  
phpが動作する環境  
cronが動作するとなお良い  

## 使い方
* TwitterInfo.phpにコンシューマーキー等を記述
* option.phpのパスを正しく設定  
(この時、コンシューマーキーなどが記載されているファイルは、ルートより上に設置するとセキュリティ的にマシかもしれない)
* users.jsonに取得したいユーザーを追加する  
以下テンプレ
    ```
    "スクリーンネーム(@~~的なやつ)": {  
        "user_id": 0,  
        "state": "",  
        "since": ""  
    }
    ```
    user_id,state,sinceは自動で挿入されるので変更不要
* cronを適時叩く
* $resultに結果が入るので加工して使う

## ライセンス
### NewTwitterGeter
MITLicense  

### cowitter
MIT License / https://github.com/mpyw/cowitter

Copyright (c) 2016 mpyw  
Permission is hereby granted, free of charge, to any person obtaining a copy  
of this software and associated documentation files (the "Software"), to deal  
in the Software without restriction, including without limitation the rights  
to use, copy, modify, merge, publish, distribute, sublicense, and/or sell  
copies of the Software, and to permit persons to whom the Software is  
furnished to do so, subject to the following conditions:  

The above copyright notice and this permission notice shall be included in all  
copies or substantial portions of the Software.

THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR  
IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,  
FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE  
AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER  
LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE  
SOFTWARE.  
