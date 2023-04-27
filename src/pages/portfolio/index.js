import React, { useState } from "react"
import { Link, graphql } from 'gatsby'
import Img from "gatsby-image"
import BackgroundImage from 'gatsby-background-image'
import LayoutStandard from '../../components/layouts/Standard' 

export default function Portfolio({ data }) {

  const [active, setActive] = useState('everything');
	
  return (

  		<LayoutStandard>

	  		<section className="row page-title">

          <div className="container">

  	  			<div className="col-7">

  	  				<h1>Portfolio</h1>

  	  			</div>

          </div>

	  		</section>

        <section id="tags" className="row">

          <div className="container">

            <div className="col-12">

              <ul className="tags">

                <li><a className={active === 'everything' ? 'button active' : 'button'} href="#!" onClick={function(){ setActive('everything'); console.log(active); }}>Everything</a></li>
                <li><a className={active === 'product-ui' ? 'button active' : 'button'} href="#!" onClick={function(){ setActive('product-ui'); console.log(active);}}>Product UI</a></li>
                <li><a className={active === 'marketing-site-ui' ? 'button active' : 'button'} href="#!" onClick={function(){ setActive('marketing-site-ui'); console.log(active);}}>Marketing Site</a></li>
                <li><a className={active === 'e-commerce' ? 'button active' : 'button'} href="#!" onClick={function(){ setActive('e-commerce'); console.log(active);}}>eCommerce</a></li>
                {/*<li><a className={active === 'experimental' ? 'button active' : 'button'} href="#!" onClick={function(){ setActive('experimental'); console.log(active);}}>Experimental</a></li>*/}

              </ul>

            </div>

            </div>

        </section>

	  		<section className="archive-container">

          <div className="container">

            <div className="row">

    	  			{data.allWpPortfolio.nodes.map(post => (

                <div className={((post.portfolioCategories.nodes.map(tag => tag.slug).indexOf(active) >= 0) || active === 'everything') ? 'col-12 archive-portfolio active' : 'col-12 archive-portfolio' }>

      		  			<div className="wrap">
                        
                    <Link to={'/portfolio/' + post.slug} className="image">{post.featuredImage ? <BackgroundImage fluid={post.featuredImage.node.localFile.childImageSharp.fluid} className="bgImage"/> : null }</Link>

                    <div className="rightSide">

                      <div className="text">

                        <Link to={'/portfolio/' + post.slug}><h3>{post.portfolioData.projectSimpleTitle}</h3></Link>
                        <p className="meta">{(post.portfolioTags.nodes.length > 0) ? post.portfolioTags.nodes[0].name : ''}</p>
                        <p dangerouslySetInnerHTML={{ __html: post.portfolioData.projectSimpleDescription }}></p>

                      </div>

                      <Link to={'/portfolio/' + post.slug} className="button">Read More</Link>

                    </div>

                  </div>

                </div>

    	  			))}

            </div>

          </div>

	  		</section>

  		</LayoutStandard>
  	)
}

export const pageQuery = graphql`
  query {
  allWpPortfolio(
    filter: {portfolioData: {showOnHomepage: {eq: true}}} 
    sort: {fields: date, order: DESC}){
    nodes {
      content
      slug
      portfolioTags {
        nodes {
          slug
          name
        }
      }
      portfolioCategories {
        nodes {
          slug
          name
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