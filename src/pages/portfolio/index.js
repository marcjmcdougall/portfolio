import React from "react"
import { Link, graphql } from 'gatsby'
import Img from "gatsby-image"
import LayoutStandard from '../../components/layouts/Standard' 

export default function Portfolio({ data }) {
	
  return (

  		<LayoutStandard>

	  		<section className="row">

	  			<div className="col-7">

	  				<h1>Portfolio</h1>

	  			</div>

	  		</section>

	  		<section className="row archive-container">

	  			{data.allWpPortfolio.nodes.map(post => (

		  			<div className="col-4 archive-portfolio">

		  				<Link to={'/portfolio/' + post.slug}>{post.featuredImage ? <Img fluid={post.featuredImage.node.localFile.childImageSharp.fluid}/> : null }</Link>
		  				<Link to={'/portfolio/' + post.slug}><h3>{post.portfolioItems.projectSimpleTitle}</h3></Link>
		  				<p dangerouslySetInnerHTML={{ __html: post.portfolioItems.projectSimpleDescription }}></p>
		  				<Link to={'/portfolio/' + post.slug} className="fancy-link">Read More</Link>

		  			</div>

	  			))}

	  		</section>

  		</LayoutStandard>
  	)
}

export const pageQuery = graphql`
  query {
  allWpPortfolio(sort: { fields: [date], order: DESC }){
    nodes {
      content
      slug
      featuredImage {
        node {
          localFile {
            childImageSharp {
              fluid {
              	
                ...GatsbyImageSharpFluid
              }
            }
          }
          id
        }
      }
      portfolioItems {
        projectSimpleDescription
        projectSimpleTitle
        results
      }
    }
  }
}

`