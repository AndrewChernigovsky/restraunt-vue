import gulp from 'gulp';
import svgSprite from 'gulp-svg-sprite';

export const createSprite = () => {
  return gulp.src('src/images/icons/*.svg') // Adjust the path to your SVG files
    .pipe(svgSprite({
      mode: {
        sprite: "sprite.svg",
        name: 'sprite',
      },

      shape: {
        transform: [
          {
            svgo: {
              plugins: [
                {
                  name: 'removeAttrs', // Specify plugin name
                  params: {
                    attrs: '(fill|stroke)' // Remove fill and stroke attributes
                  }
                },
                {
                  name: 'addAttributesToSVGElement', // Specify plugin name
                  params: {
                    attributes: [
                      {
                        'fill': 'currentColor' // Set fill to currentColor
                      },
                      {
                        'stroke': 'currentColor' // Set stroke to currentColor
                      }
                    ]
                  }
                }
              ]
            }
          }
        ]
      }
    }))
    .pipe(gulp.dest('src/asstes/images/')); // Output destination
};

// Default task
const defaultTask = gulp.series(createSprite);

export default defaultTask;
