import gulp from 'gulp';
import svgSprite from 'gulp-svg-sprite';

export const createSprite = () => {
  return gulp.src('src/images/icons/**/*.svg')
    .pipe(svgSprite({
      mode: {

        stack: {
          sprite: "sprite.svg",
        },
      },

      shape: {
        transform: [
          {
            svgo: {
              plugins: [
                {
                  name: 'removeAttrs',
                  params: {
                    attrs: '(fill|stroke)'
                  }
                },
                {
                  name: 'addAttributesToSVGElement',
                  params: {
                    attributes: [
                      {
                        'fill': 'currentColor'
                      },
                      {
                        'stroke': 'currentColor'
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
    .pipe(gulp.dest('src/assets/images/'));
};

const defaultTask = gulp.series(createSprite);

export default defaultTask;
