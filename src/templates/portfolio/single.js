import React from "react"
import { graphql, Link } from 'gatsby'
import Img from "gatsby-image"
import LayoutStandard from '../../components/layouts/Standard' 

export default function SinglePortfolio({data}) {

	const post = data.allWpPortfolio.nodes[0]
	
  	return (

  		<LayoutStandard>

	  		<section className="row">

	  			<div className="col-8">

	  				<h1>{post.title}</h1>

	  			</div>

	  		</section>

	  		<section className="row">

	  			
	  			<div className="col-8 blog-content">

	  				<div className="wrapper" dangerouslySetInnerHTML={{ __html: post.content }}/>

	  			</div>

	  			<div className="col-4 featured-image">
	  				
	  				<Img fluid={post.portfolioItems.sidebarImage.localFile.childImageSharp.fluid} />

	  			</div>

	  		</section>

  		</LayoutStandard>
  	)
}

export const query = graphql`
  query($slug: String!) {
    allWpPortfolio(filter: { slug: { eq: $slug } }) {
      nodes {
        title
        content
        portfolioItems {
	      siteUrl {
	        url
	      }
	      linkToSite
	      sidebarImage {
	          localFile {
	            childImageSharp {
	              fluid {
	                ...GatsbyImageSharpFluid
	              }
	            }
	          }
	        }
	    }
        featuredImage {
	        node {
	          localFile {
	            childImageSharp{
	            	fluid{
	            		...GatsbyImageSharpFluid
	            	}
	            }
	          }
	        }
	      }
      }
    }
  }
`