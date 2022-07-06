import React, { useState } from "react"
import { Link, graphql } from 'gatsby'
import Img from "gatsby-image"
import LayoutStandard from '../../components/layouts/Standard' 

export default function Portfolio({ data }) {

  const [active, setActive] = useState('everything');
	
  return (

  		<LayoutStandard>

	  		<section className="row">

	  			<div className="col-7">

	  				<h1>Portfolio</h1>

	  			</div>

	  		</section>

        <section id="tags" className="row">

          <div className="col-12">

            <ul className="tags">

              <li><a className={active === 'everything' ? 'button active' : 'button'} href="#!" onClick={function(){ setActive('everything'); console.log(active); }}>Everything</a></li>
              <li><a className={active === 'product-ux' ? 'button active' : 'button'} href="#!" onClick={function(){ setActive('product-ux'); console.log(active);}}>Product UX</a></li>
              <li><a className={active === 'redesign' ? 'button active' : 'button'} href="#!" onClick={function(){ setActive('redesign'); console.log(active);}}>Site Redesign</a></li>
              <li><a className={active === 'experimental' ? 'button active' : 'button'} href="#!" onClick={function(){ setActive('experimental'); console.log(active);}}>Experimental</a></li>

            </ul>

          </div>

        </section>

	  		<section className="row archive-container">

	  			{data.allWpPortfolio.nodes.map(post => (

		  			<div className={((post.portfolioTags.nodes.map(tag => tag.slug).indexOf(active) >= 0) || active === 'everything') ? 'col-4 archive-portfolio active' : 'col-4 archive-portfolio' }>

		  				<Link to={'/portfolio/' + post.slug}>{post.featuredImage ? <Img fluid={post.featuredImage.node.localFile.childImageSharp.fluid}/> : null }</Link>
		  				<Link to={'/portfolio/' + post.slug}><h3>{post.portfolioData.projectSimpleTitle}</h3></Link>
		  				<p dangerouslySetInnerHTML={{ __html: post.portfolioData.projectSimpleDescription }}></p>
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
      portfolioTags {
        nodes {
          slug
        }
      }
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
      portfolioData {
        projectSimpleDescription
        projectSimpleTitle
        results
      }
    }
  }
}

`