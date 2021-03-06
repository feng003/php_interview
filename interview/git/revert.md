## 撤销一个“已公开”的改变

场景: 你已经执行了 git push, 把你的修改发送到了 GitHub，现在你意识到这些 commit 的其中一个是有问题的，你需要撤销那一个 commit.

方法: git revert <SHA>

原理: git revert 会产生一个新的 commit，它和指定 SHA 对应的 commit 是相反的（或者说是反转的）。如果原先的 commit 是“物质”，新的 commit 就是“反物质” — 任何从原先的 commit 里删除的内容会在新的 commit 里被加回去，任何在原先的 commit 里加入的内容会在新的 commit  里被删除。

这是 Git 最安全、最基本的撤销场景，因为它并不会改变历史 — 所以你现在可以  git push 新的“反转” commit 来抵消你错误提交的 commit。

## 撤销“本地的”修改

场景: 一只猫从键盘上走过，无意中保存了修改，然后破坏了编辑器。不过，你还没有 commit 这些修改。你想要恢复被修改文件里的所有内容 — 就像上次 commit 的时候一模一样。

方法: git checkout -- <bad filename>

原理: git checkout 会把工作目录里的文件修改到 Git 之前记录的某个状态。你可以提供一个你想返回的分支名或特定 SHA ，或者在缺省情况下，Git 会认为你希望 checkout 的是 HEAD，当前 checkout 分支的最后一次 commit。

记住：你用这种方法“撤销”的任何修改真的会完全消失。因为它们从来没有被提交过，所以之后 Git 也无法帮助我们恢复它们。你要确保自己了解你在这个操作里扔掉的东西是什么！（也许可以先利用 git diff 确认一下）


## 在撤销“本地修改”之后再恢复

场景: 你提交了几个 commit，然后用 git reset --hard 撤销了这些修改（见上一段），接着你又意识到：你希望还原这些修改！

方法: git reflog 和 git reset 或 git checkout

原理: git reflog 对于恢复项目历史是一个超棒的资源。你可以恢复几乎 任何东西 — 任何你 commit 过的东西 — 只要通过 reflog。

你可能已经熟悉了 git log 命令，它会显示 commit 的列表。 git reflog 也是类似的，不过它显示的是一个 HEAD 发生改变的时间列表.

> 一些注意事项：

            它涉及的只是 HEAD 的改变。在你切换分支、用 git commit 进行提交、以及用 git reset 撤销 commit 时，HEAD 会改变，但当你用  git checkout -- <bad filename> 撤销时（正如我们在前面讲到的情况），HEAD 并不会改变 — 如前所述，这些修改从来没有被提交过，因此 reflog 也无法帮助我们恢复它们。
            git reflog 不会永远保持。Git 会定期清理那些 “用不到的” 对象。不要指望几个月前的提交还一直躺在那里。
            你的 reflog 就是你的，只是你的。你不能用 git reflog 来恢复另一个开发者没有 push 过的 commit。

            那么…你怎么利用 reflog 来“恢复”之前“撤销”的 commit 呢？它取决于你想做到的到底是什么：

            如果你希望准确地恢复项目的历史到某个时间点，用 git reset --hard <SHA>
            如果你希望重建工作目录里的一个或多个文件，让它们恢复到某个时间点的状态，用 git checkout <SHA> -- <filename>
            如果你希望把这些 commit 里的某一个重新提交到你的代码库里，用 git cherry-pick <SHA>

