const path = require(`path`)

exports.createPages = ({ graphql, actions }) => {

  const { createPage } = actions

  return graphql(`
    {
      allWpPortfolio(sort: { fields: [date] }) {

        nodes {
          title
          slug
        }
      }
    }
  `).then(result => {

    result.data.allWpPortfolio.nodes.forEach(node => {

      createPage({
        path: '/portfolio/' + node.slug,
        component: path.resolve(`./src/pages/portfolio/single.js`),
        context: {
          // This is the $slug variable
          // passed to single.js
          slug: node.slug,
        },
      })
    })
  })
}