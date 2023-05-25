import { defineConfig } from "vite";
import laravel from "laravel-vite-plugin";
import { glob } from "glob";

export default defineConfig({
    plugins: [
        laravel({
            input: [
                "resources/css/app.css",
                ...glob.sync("resources/js/page/**/*.js"),
            ],
            refresh: true,
        })
    ],
});
