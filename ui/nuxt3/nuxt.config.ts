// https://nuxt.com/docs/api/configuration/nuxt-config
export default defineNuxtConfig({
  devtools: { enabled: true },
  // spaモードを有効にする
  ssr: false,
  // その他の設定
  app: {
    // headタグの設定
    head: {
      title: "My SPA Site",
      meta: [
        { charset: "utf-8" },
        { name: "viewport", content: "width=device-width, initial-scale=1" },
      ],
    },
  },
});
