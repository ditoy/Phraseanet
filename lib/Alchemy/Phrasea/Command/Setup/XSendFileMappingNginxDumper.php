<?php

/*
 * This file is part of Phraseanet
 *
 * (c) 2005-2013 Alchemy
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Alchemy\Phrasea\Command\Setup;

use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

/**
 * This command dumps XSendFile Nginx configuration
 */
class XSendFileMappingNginxDumper extends AbstractXSendFileMappingDumper
{
    public function __construct()
    {
        parent::__construct('xsendfile:dump-nginx');

        $this->setDescription('Dump xsendfile mapping for Nginx web server');
    }

    /**
     * {@inheritdoc}
     */
    protected function doDump(InputInterface $input, OutputInterface $output)
    {
        $mapper = $this->container['phraseanet.xsendfile-mapping'];
        $output->writeln('<info>Nginx XSendfile configuration</info>');
        $output->writeln('');
        foreach ($this->container['phraseanet.xsendfile-mapping']->getMapping() as $entry) {
            $output->writeln('  location ' . $mapper->sanitizeMountPoint($entry['mount-point']) . ' {');
            $output->writeln('      internal;');
            $output->writeln('      add_header Etag $upstream_http_etag;');
            $output->writeln('      add_header Link $upstream_http_link;');
            $output->writeln('      alias ' .  $mapper->sanitizePath($entry['directory']) . ';');
            $output->writeln('  }');
            $output->writeln('');
        }

        return 0;
    }
}
