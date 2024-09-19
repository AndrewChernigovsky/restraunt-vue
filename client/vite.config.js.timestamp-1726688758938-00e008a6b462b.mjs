// vite.config.js
import { defineConfig } from "file:///E:/AndreyProjects/OSPanel/domains/restraunt-vue/client/node_modules/.pnpm/vite@5.4.2_sass@1.77.8/node_modules/vite/dist/node/index.js";
import vue from "file:///E:/AndreyProjects/OSPanel/domains/restraunt-vue/client/node_modules/.pnpm/@vitejs+plugin-vue@5.1.2_vite@5.4.2_vue@3.4.38/node_modules/@vitejs/plugin-vue/dist/index.mjs";
import * as path from "path";
import svgLoader from "file:///E:/AndreyProjects/OSPanel/domains/restraunt-vue/client/node_modules/.pnpm/vite-svg-loader@5.1.0_vue@3.4.38/node_modules/vite-svg-loader/index.js";
var __vite_injected_original_dirname = "E:\\AndreyProjects\\OSPanel\\domains\\restraunt-vue\\client";
var vite_config_default = defineConfig({
  plugins: [
    vue(),
    svgLoader()
  ],
  resolve: {
    alias: {
      "@": path.resolve(__vite_injected_original_dirname, "src")
      // Устанавливаем алиас '@' для папки 'src'
    },
    extensions: [".js", ".ts", ".jsx", ".tsx", ".vue"]
  },
  css: {
    preprocessorOptions: {
      scss: {
        additionalData: `
          @import "@/styles/global.scss";
        `
      }
    }
  }
});
export {
  vite_config_default as default
};
//# sourceMappingURL=data:application/json;base64,ewogICJ2ZXJzaW9uIjogMywKICAic291cmNlcyI6IFsidml0ZS5jb25maWcuanMiXSwKICAic291cmNlc0NvbnRlbnQiOiBbImNvbnN0IF9fdml0ZV9pbmplY3RlZF9vcmlnaW5hbF9kaXJuYW1lID0gXCJFOlxcXFxBbmRyZXlQcm9qZWN0c1xcXFxPU1BhbmVsXFxcXGRvbWFpbnNcXFxccmVzdHJhdW50LXZ1ZVxcXFxjbGllbnRcIjtjb25zdCBfX3ZpdGVfaW5qZWN0ZWRfb3JpZ2luYWxfZmlsZW5hbWUgPSBcIkU6XFxcXEFuZHJleVByb2plY3RzXFxcXE9TUGFuZWxcXFxcZG9tYWluc1xcXFxyZXN0cmF1bnQtdnVlXFxcXGNsaWVudFxcXFx2aXRlLmNvbmZpZy5qc1wiO2NvbnN0IF9fdml0ZV9pbmplY3RlZF9vcmlnaW5hbF9pbXBvcnRfbWV0YV91cmwgPSBcImZpbGU6Ly8vRTovQW5kcmV5UHJvamVjdHMvT1NQYW5lbC9kb21haW5zL3Jlc3RyYXVudC12dWUvY2xpZW50L3ZpdGUuY29uZmlnLmpzXCI7aW1wb3J0IHsgZGVmaW5lQ29uZmlnIH0gZnJvbSAndml0ZSdcclxuaW1wb3J0IHZ1ZSBmcm9tICdAdml0ZWpzL3BsdWdpbi12dWUnXHJcbmltcG9ydCAqIGFzIHBhdGggZnJvbSAncGF0aCc7XHJcbmltcG9ydCBzdmdMb2FkZXIgZnJvbSAndml0ZS1zdmctbG9hZGVyJztcclxuXHJcbmV4cG9ydCBkZWZhdWx0IGRlZmluZUNvbmZpZyh7XHJcbiAgcGx1Z2luczogW1xyXG4gICAgdnVlKCksXHJcbiAgICBzdmdMb2FkZXIoKSxcclxuICBdLFxyXG4gIHJlc29sdmU6IHtcclxuICAgIGFsaWFzOiB7XHJcbiAgICAgICdAJzogcGF0aC5yZXNvbHZlKF9fZGlybmFtZSwgJ3NyYycpLCAvLyBcdTA0MjNcdTA0NDFcdTA0NDJcdTA0MzBcdTA0M0RcdTA0MzBcdTA0MzJcdTA0M0JcdTA0MzhcdTA0MzJcdTA0MzBcdTA0MzVcdTA0M0MgXHUwNDMwXHUwNDNCXHUwNDM4XHUwNDMwXHUwNDQxICdAJyBcdTA0MzRcdTA0M0JcdTA0NEYgXHUwNDNGXHUwNDMwXHUwNDNGXHUwNDNBXHUwNDM4ICdzcmMnXHJcbiAgICB9LFxyXG4gICAgZXh0ZW5zaW9uczogWycuanMnLCAnLnRzJywgJy5qc3gnLCAnLnRzeCcsICcudnVlJ11cclxuICB9LFxyXG4gIGNzczoge1xyXG4gICAgcHJlcHJvY2Vzc29yT3B0aW9uczoge1xyXG4gICAgICBzY3NzOiB7XHJcbiAgICAgICAgYWRkaXRpb25hbERhdGE6IGBcclxuICAgICAgICAgIEBpbXBvcnQgXCJAL3N0eWxlcy9nbG9iYWwuc2Nzc1wiO1xyXG4gICAgICAgIGBcclxuICAgICAgfVxyXG4gICAgfVxyXG4gIH0sXHJcbn0pXHJcbiJdLAogICJtYXBwaW5ncyI6ICI7QUFBZ1csU0FBUyxvQkFBb0I7QUFDN1gsT0FBTyxTQUFTO0FBQ2hCLFlBQVksVUFBVTtBQUN0QixPQUFPLGVBQWU7QUFIdEIsSUFBTSxtQ0FBbUM7QUFLekMsSUFBTyxzQkFBUSxhQUFhO0FBQUEsRUFDMUIsU0FBUztBQUFBLElBQ1AsSUFBSTtBQUFBLElBQ0osVUFBVTtBQUFBLEVBQ1o7QUFBQSxFQUNBLFNBQVM7QUFBQSxJQUNQLE9BQU87QUFBQSxNQUNMLEtBQVUsYUFBUSxrQ0FBVyxLQUFLO0FBQUE7QUFBQSxJQUNwQztBQUFBLElBQ0EsWUFBWSxDQUFDLE9BQU8sT0FBTyxRQUFRLFFBQVEsTUFBTTtBQUFBLEVBQ25EO0FBQUEsRUFDQSxLQUFLO0FBQUEsSUFDSCxxQkFBcUI7QUFBQSxNQUNuQixNQUFNO0FBQUEsUUFDSixnQkFBZ0I7QUFBQTtBQUFBO0FBQUEsTUFHbEI7QUFBQSxJQUNGO0FBQUEsRUFDRjtBQUNGLENBQUM7IiwKICAibmFtZXMiOiBbXQp9Cg==
