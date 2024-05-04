/**
 * Configure your Gatsby site with this file.
 *
 * See: https://www.gatsbyjs.com/docs/gatsby-config/
 */
const path = require(`path`)

module.exports = {
  /* Your site config here */
  flags: {
    DEV_SSR: true
  },
  plugins: [
    'gatsby-transformer-ffmpeg',
    {
      resolve: 'gatsby-plugin-image',
      options: {
        html: { 
          useGatsbyImage: false 
        }
      }
    },
  	'gatsby-transformer-sharp',
  	'gatsby-plugin-sharp',
    {
      resolve: 'gatsby-plugin-web-font-loader',
      options: {

        typekit: {
          id: process.env.TYPEKIT_ID
        }
      }
    },
    {
      resolve: `gatsby-source-filesystem`,
      options: {
        name: `images`,
        path: path.join(__dirname, `src`, `img`),
      },
    },
  	{
      resolve: `gatsby-source-wordpress`,
      options: {
        url:
        // allows a fallback url if WPGRAPHQL_URL is not set in the env, this may be a local or remote WP instance.
          process.env.WPGRAPHQL_URL ||
          `https://clarityfirst.co/graphql`,
        schema: {
          //Prefixes all WP Types with "Wp" so "Post and allPost" become "WpPost and allWpPost".
          typePrefix: `WP`,
        },
        develop: {
          //caches media files outside of Gatsby's default cache an thus allows them to persist through a cache reset.
          hardCacheMediaFiles: true,
        },
        type: {
          Post: {
            limit:
              process.env.NODE_ENV === `development`
                ? // Lets just pull 50 posts in development to make it easy on ourselves (aka. faster).
                  50
                : // and we don't actually need more than 5000 in production for this particular site
                  5000,
          },
        },
      },
    },
  ],
  siteMetadata: {

  	title: 'Marc McDougall',
    titleTemplate: "%s — Software design that actually drives business results.",
    image: './src/img/favicon.png',
  	description: 'Function-first software interfaces that turn users into loyal subscribers.',
    url: "https://marcmcdougall.com"
  }
}
