# ディレクトリ構成
.
├── README.md
├── coverage
├── package-lock.json
├── package.json
├── public
├── src # ソースコード
│   ├── apis # API関連のプロダクトコードとテストコード
             # このようなテストコードとプロダクトコードを同じフォルダに入れることもテストファイルの管理方法の一つである。
             # 今回はReactの初期プロジェクトでそうなっているのでそのまましているだけ、特にどちらがいいはなくチームで決めればいい。
│   │   ├── address.test.ts
│   │   ├── address.ts
│   │   ├── apis.ts
│   │   └── axios-instance.ts
│   ├── components # コンポーネント
│   │   ├── Products.stories.tsx
│   │   ├── Products.test.tsx
│   │   └── Products.tsx
│   ├── contexts # 状態管理関連のプロダクトコードとテストコード
│   │   └── GlobalContext
│   │       ├── index.tsx
│   │       ├── reducers.test.ts
│   │       ├── reducers.ts # もっと柔軟に状態更新を実現するために、reducerを導入する
│   │       └── types.d.ts
│   ├── index.css
│   ├── index.stories.tsx
│   ├── index.tsx # ベースのtsxファイル
│   ├── pages # ページとして見せる単位のコンポーネント
│   │   ├── Customer
│   │   │   ├── Customer.stories.tsx
│   │   │   ├── Customer.test.tsx
│   │   │   └── Customer.tsx
│   │   └── ProductSelect
│   │       ├── ProductSelect.stories.tsx
│   │       ├── ProductSelect.test.tsx
│   │       └── ProductSelect.tsx
│   ├── react-app-env.d.ts
│   ├── reportWebVitals.ts
│   ├── router # URLのパスとのマッピング
│   │   └── Router.tsx
│   ├── setupTests.ts test実行前に実行するセットアップファイル
│   └── test-utils # テスト用ツール
│       ├── AxiosMock.tsx
│       ├── StoreFixture.ts
│       ├── Storyshots.test.ts # ビジュアルテストを実行するためのセットアップファイル
│       └── __snapshots__ # ビジュアルテストを実行するときに記録したスナップショット
│           └── Storyshots.test.ts.snap
└── tsconfig.json